<?php

namespace App\Repositories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository
{
    public function __construct(
        protected Sale $sale
    ) {}

    public function getAll(): Collection
    {
        return $this->sale->all();
    }

    public function getById(int $id): Sale
    {
        return $this->sale->find($id);
    }

    public function getByUserId(int $id): Collection
    {
        return $this->sale->where('user_id', '=', $id)->get();
    }
}