<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\PurchaseProduct;
use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function __construct(
        protected Product $product,
        protected PurchaseProduct $purchaseProduct,
        protected SaleProduct $saleProduct
    ) {}

    public function create(array $data): Product
    {
        return $this->product->create($data);
    }

    public function getAll(int|null $limit = null, string|null $term = null): Collection
    {
        $query = $this->product->newQuery();

        if ($limit) {
            $query->limit($limit);
        }

        if ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        }

        return $query->get();
    }

    public function getById(int $id): Product|null
    {
        return $this->product->find($id);
    }

    public function delete(int $id, array $data): int
    {
        return $this->product->where('id', '=', $id)->delete($data);
    }

    public function update(int $id, array $data): int
    {
        return $this->product->where('id', '=', $id)->update($data);
    }



    public function syncQuantity(int $productId): void
    {
        $purchaseProducts = $this->purchaseProduct->where('product_id', '=', $productId)->get();

        $totalPurchased = 0;

        foreach ($purchaseProducts as $purchaseProduct) {
            $totalPurchased += $purchaseProduct->quantity;
        }

        // TO DO: get sales
        $saleProducts = $this->saleProduct->where('product_id', '=', $productId)->get();

        $totalSold = 0;

        foreach ($saleProducts as $saleProduct) {
            $totalSold += $saleProduct->quantity;
        }

        $this->product->where('id', '=', $productId)->update(['quantity' => $totalPurchased - $totalSold]);
    }
}