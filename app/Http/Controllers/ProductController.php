<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $repository,
        protected CategoryRepository $categoryRepository
    ) {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page']['title'] = 'Products';

        $this->data['products'] = $this->repository->getAll();

        return view('admin.products.index', $this->data);
    }

    public function create()
    {
        $this->data['page']['title'] = 'New Product';

        $this->data['categories'] = $this->categoryRepository->getAll();

        return view('admin.products.add', $this->data);
    }

    //this one continue
    
    public function store(ProductRequest $request)
    {
        $imageFile = $request->file('image');
        $imageFile->store('public/uploads/products');
        
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'cost' =>  $request->input('cost'),
            'price' =>  $request->input('price'),
            'image' => $imageFile->hashName(),
        ];
        
        
        if ($this->repository->create($data)) {
            return redirect('admin/products')->with('message', 'Product added successfully');
        }
    }

    public function delete(int $id)
    {
        $product = $this->repository->getById($id);

        if ($product) {
            $product->delete();
        }
        
        return redirect('admin/products')->with('message', 'Product deleted successfully');
    }

    public function edit(int $id)
    {
        $this->data['page']['title'] = 'Edit Product';

        $this->data['categories'] = $this->categoryRepository->getAll();
        $this->data['product'] = $this->repository->getById($id);

        return view('admin.products.edit', $this->data);
    }

    public function update(ProductRequest $request, int $id)
    {
        $imageFile = $request->file('image');

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'cost' => $request->input('cost'),
        ];
        
        if ($imageFile) {
            $imageFile->store('public/uploads/products');
            $data['image'] = $imageFile->hashName();
        }

        if ($this->repository->update($id, $data)) {
            return redirect('admin/products')->with('message', 'Product updated successfully');
        }

        return redirect('admin/products/' . $id);
    }


}