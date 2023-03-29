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

    public function add_to_cart()
    {
        // Ambil data produk dari database atau sumber data lainnya
        $product_data = $this->model->getBarang($this->request->getPost('id_barang'));

        // Buat array untuk disimpan ke dalam session
        $product = [
            'id' => $product_data['id_barang'],
            'qty' => 1,
            'price' => $product_data['harga'],
            'name' => $product_data['nama'],
            'gambar' => $product_data['gambar']
        ];

        // Jika session cart belum ada maka buat cart baru
        if (!session()->has('cart')) {
            session()->set('cart', []);
        }

        // Cek apakah produk sudah ada di dalam cart, jika sudah maka tambahkan qty nya saja, jika belum maka tambahkan produk baru ke cart session
        $cart = session()->get('cart');
        if (array_key_exists($product['id'], $cart)) {
            $cart[$product['id']]['qty'] += 1;
        } else {
            $cart[$product['id']] = $product;
        }
        session()->set('cart', $cart);

        // Redirect ke halaman cart
        return redirect()->to('/cart');
    }

    public function delete_product_in_cart()
    {
        $cart = session()->get('cart');
        unset($cart[$this->request->getPost('id')]);
        session()->set('cart', $cart);
        return redirect()->to('/cart');
    }
}
