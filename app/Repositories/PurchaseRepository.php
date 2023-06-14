<?php

namespace App\Repositories;

use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Illuminate\Database\Eloquent\Collection;

class PurchaseRepository
{
    public function __construct(
        protected Purchase $purchase,
        protected PurchaseProduct $purchaseProduct,
        protected ProductRepository $productRepository
    ) {}

    public function create(array $data, array $products): Purchase
    {
        $purchase = $this->purchase->create($data);

        foreach ($products as $product) {
            $product['purchase_id'] = $purchase->id;
            $this->purchaseProduct->create($product);
            $this->productRepository->syncQuantity($product['product_id']);//for product quantity update
        }

        return $purchase;
    }

    public function getAll(): Collection
    {
        return $this->purchase->all();
    }

    public function getById(int $id): Purchase|null
    {
        return $this->purchase->find($id);
    }
}