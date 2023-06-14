<?php

namespace App\Http\Controllers;

use App\Repositories\SaleRepository;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(
        protected SaleRepository $saleRepository
    ) {
        parent::__construct();
    }

    // buyer order table page
    public function index()
    {
        $this->data['page']['title'] = 'My Orders';

        $this->data['orders'] = $this->saleRepository->getByUserId(Auth::id());

        return view('shop.orders', $this->data);
    }
}