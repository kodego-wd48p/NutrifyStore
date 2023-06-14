<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Sale;
use App\Models\SaleProduct;

class CartRepository
{
    public function __construct(
        protected Cart $cart,
        protected CartProduct $cartProduct,
        protected Sale $sale,
        protected SaleProduct $saleProduct,
        protected ProductRepository $productRepository
    ) {}

    public function getCartTotal(int|null $userId): float
    {
        $cartProducts = $this->cart
            ->where('user_id', '=', $userId)
            ->first()
            ?->cartProducts;

        $total = 0;
        
        foreach ($cartProducts as $cartProduct) {
            $total += $cartProduct->quantity * $cartProduct->product->price;
        }
        return $total;
    }

    public function update(int $id, array $data): bool
    {
        foreach ($data as $row) {
            $this->cartProduct->where([
                'cart_id' => $id,
                'product_id' => $row['product_id'],
            ])->update(['quantity' => $row['quantity']]);
        }

        return true;
    }

    public function getById(int $id): Cart|null
    {
        return $this->cart->find($id);
    }

    public function checkout(int $id)
    {
        $cart = $this->getById($id);

        if ($cart) {
            $cartProducts = $cart->cartProducts;

            $grandTotal = 0;
            $saleProducts = [];
            // Cart product computation amount
            foreach ($cartProducts as $cartProduct) {
                $subTotal = $cartProduct->quantity * $cartProduct->product->price;
                $grandTotal += $subTotal;

                $saleProducts[] = [
                    'product_id' => $cartProduct->product->id,
                    'price' => $cartProduct->product->price,
                    'quantity' => $cartProduct->quantity,
                    'subtotal' => $subTotal
                ];
            }

            $sale = $this->sale->create([
                'user_id' => $cart->user_id,
                'status' => 'ordered',
                'grand_total' => $grandTotal,
                'payment_status' => 'pending'
            ]);

            foreach ($saleProducts as $saleProduct) {
                $saleProduct['sale_id'] = $sale->id;

                $this->saleProduct->create($saleProduct);
                $this->cartProduct->where([
                    'cart_id' => $id,
                    'product_id' => $saleProduct['product_id']
                ])->delete();
                $this->productRepository->syncQuantity($saleProduct['product_id']);
            }

            $cart->delete();

            return true;
        }

        return false;
    }

    public function addToCart(array $data): Cart
    {
        $cart = $this->cart->firstOrCreate(['user_id' => auth()->user()->id]);

        $data['cart_id'] = $cart->id;
        $this->cartProduct->create($data);

        return $cart;
    }
}