<?php

namespace App\Controllers;

class C_Home extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\Barang();
    }

    public function index()
    {
        return view('v_home', [
            'title' => 'Welcome',
            'barang' => $this->model->getAllBarang()
        ]);
    }

    public function cart()
    {
        return view('v_cart', [
            'title' => 'Cart'
        ]);
    }
}
