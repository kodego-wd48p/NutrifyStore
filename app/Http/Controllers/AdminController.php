<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page']['title'] = 'Dashboard';

        return view('admin.dashboard', $this->data);
    }
}