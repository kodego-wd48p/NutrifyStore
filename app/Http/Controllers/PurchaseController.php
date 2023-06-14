<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseRepository;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    public function __construct(
        protected PurchaseRepository $repository,
        protected ProductRepository $productRepository
    ) {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page']['title'] = 'Purchases';

        $this->data['purchases'] = $this->repository->getAll();

        return view('admin.purchases.index', $this->data);
    }

    public function create()
    {
        $this->data['page']['title'] = 'New Purchase';

        $this->data['products'] = $this->productRepository->getAll();

        return view('admin.purchases.add', $this->data);
    }

    public function store(PurchaseRequest $request)
    {
        $data = [
            'status' => $request->input('status'),
        ];

        $purchaseProduct = [];

        foreach ($request->input('product_id') as $index => $product_id) {
            $cost = $request->input('cost')[$index];
            $quantity = $request->input('quantity')[$index];
            $expiration = $request->input('expiration')[$index];

            $purchaseProduct[] = [
                'product_id' => $product_id,
                'cost' => $cost,
                'quantity' => $quantity,
                'subtotal' => $cost * $quantity,
                'expiration' => Carbon::parse($expiration)->format('Y-m-d')
            ];
        }

        if ($this->repository->create($data, $purchaseProduct)) {
            return redirect('admin/purchases')->with('message', 'Purchase added successfully');
        }

        return redirect('admin/purchases/add');
    }

    public function show(int $id)
    {
        $this->data['page']['title'] = 'Purchase Details';

        $this->data['purchase'] = $this->repository->getById($id);

        return view('admin.purchases.show', $this->data);
    }
}