<?php

namespace App\Http\Controllers;

use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        protected SaleRepository $repository
    ) {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page']['title'] = 'Sales & Orders';

        $this->data['sales'] = $this->repository->getAll();

        return view('admin.sales.index', $this->data);
    }

    public function show(int $id)
    {
        $this->data['page']['title'] = 'Sale Details';

        $this->data['sale'] = $this->repository->getById($id);

        return view('admin.sales.show', $this->data);
    }

    public function updateStatus(Request $request)
    {
        $sale = $this->repository->getById($request->input('id'));

        if ($sale) {
            $sale->status = $request->input('status');
            $sale->save();

            return redirect('admin/sales')->with('message', 'Sale status successfully updated.');
        }

        return redirect('admin/sales')->with('error', 'Sale no longer exists');
    }

    public function updatePaymentStatus(Request $request)
    {
        $sale = $this->repository->getById($request->input('id'));

        if ($sale) {
            $sale->payment_status = $request->input('payment_status');
            $sale->save();

            return redirect('admin/sales')->with('message', 'Sale payment status successfully updated.');
        }

        return redirect('admin/sales')->with('error', 'Sale no longer exists');
    }
}