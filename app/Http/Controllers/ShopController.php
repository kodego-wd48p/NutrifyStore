<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository
    ) {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page']['title'] = 'Home';

        $this->data['categories'] = $this->categoryRepository->getAll(5);
        $this->data['products'] = $this->productRepository->getAll(8);

        return view('shop.home', $this->data);
    }

    public function products(Request $request)
    {
        $this->data['page']['title'] = 'Products';

        $term = $request->query('term');

        $this->data['categories'] = $this->categoryRepository->getAll();
        $this->data['products'] = $this->productRepository->getAll(null, $term);
        $this->data['term'] = $term;

        return view('shop.products', $this->data);
    }
}