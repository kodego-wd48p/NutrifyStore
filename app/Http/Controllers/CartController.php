<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(
        protected CartRepository $cartRepository
    ) {
        parent::__construct();
    }

    public function index()
    {
        // will show on url to see correct current page
        $this->data['page']['title'] = 'Cart';
        $this->data['cart'] = Auth::user()->cart;

        $cartProducts = Auth::user()->cart?->cartProducts ?? [];

        $this->data['cartProducts'] = $cartProducts;

        $this->data['cartTotal'] = 0;

        // for sub-total calculation when changing qty (qty*price)  
        foreach ($cartProducts as $cartProduct) {
            $this->data['cartTotal'] += $cartProduct->quantity * $cartProduct->product->price;
        }

        return view('shop.cart', $this->data);
    }

    public function update(CartRequest $request, int $id)
    {
        $products = $request->input('product_id');
        $data = [];

        // edit qty product in cart
        foreach ($products as $index => $productId) {
            $data[] = [
                'product_id' => $productId,
                'quantity' => $request->input('quantity')[$index],
            ];
        }

        // update qty product in cart and also will update amount in checkout
        $this->cartRepository->update($id, $data);
        return redirect('shop/cart')->with('message', 'Cart updated successfully');
    }

    public function checkout(int $id)
    {
        if ($this->cartRepository->checkout($id)) {
            return redirect('shop/orders')->with('message', 'Checkout successful');
        }

        return redirect('shop/cart')->with('error', 'Checkout unsuccessful, please try again');
    }

    public function addToCart(CartRequest $request)
    {
        
        $data = [
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ];

        if ($this->cartRepository->addToCart($data)) {
            return redirect('shop/cart')->with('message', 'Product successfully added to cart');
        }

        return redirect('shop/cart')->with('error', 'Add to cart unsuccessful, please try again');
    }
}