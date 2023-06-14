<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct(
        protected Category $category
    ) {}

    public function create(array $data): Category
    {
        return $this->category->create($data);
    }

    public function getAll(int|null $limit = null)
    {
        $query = $this->category->newQuery();

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    public function getById(int $id): Category|null
    {
        return $this->category->find($id);
    }

    public function update(int $id, array $data): int
    {
        return $this->category->where('id', '=', $id)->update($data);
    }
}