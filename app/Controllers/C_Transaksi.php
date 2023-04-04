<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Transaksi extends BaseController
{

    protected $model_barang;
    protected $model_transaksi_penjualan;
    protected $model_jual;

    public function __construct()
    {
        $this->model_barang = new \App\Models\Barang();
        $this->model_transaksi_penjualan = new \App\Models\TransaksiPenjualan;
        $this->model_jual = new \App\Models\Jual;
    }

    public function add_to_cart()
    {
        // Ambil data produk dari database atau sumber data lainnya
        $product_data = $this->model_barang->getBarang($this->request->getPost('id_barang'));

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

        // jika cart kosong maka hapus session cart
        if (count($cart) == 0) {
            session()->remove('cart');
        }

        return redirect()->to('/cart');
    }

    public function update_qty_cart()
    {
        $id = $this->request->getPost('id');
        $qty = $this->request->getPost('qty');

        // Ambil data produk dari database atau sumber data lainnya
        $product_data = $this->model_barang->getBarang($id);

        // Buat array untuk disimpan ke dalam session
        $product = [
            'id' => $product_data['id_barang'],
            'qty' => $qty,
            'price' => $product_data['harga'],
            'name' => $product_data['nama'],
            'gambar' => $product_data['gambar']
        ];

        $cart = session()->get('cart');

        // Cek apakah produk sudah ada di dalam cart, jika sudah maka tambahkan qty nya saja, jika belum maka tambahkan produk baru ke cart session
        if (array_key_exists($product['id'], $cart)) {
            $cart[$product['id']]['qty'] = $qty;
        } else {
            $cart[$product['id']] = $product;
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Qty berhasil diupdate',
            'data' => $cart
        ]);
    }

    public function checkout()
    {
        $data_checkout = [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'tanggal' => date('Y-m-d H:i:s'),
            'total_transaksi' =>  $this->request->getPost('total_transaksi'),
        ];

        // get data cart pada session cart
        $cart = session()->get('cart');
        $id_barang = [];
        foreach ($cart as $key => $value) {
            $id_barang[] = $key;
        }

        // insert data transaksi_penjualan
        $transaksi = $this->model_transaksi_penjualan->insert($data_checkout);

        // insert data ke tabel jual
        $data_jual = [];
        foreach ($cart as $key => $value) {
            $data_jual[] = [
                'no_transaksi' => $transaksi,
                'barang_id' => $key,
                'jumlah_jual' => $value['qty'],
                'harga_jual' => $value['price'],
            ];
        }

        $produk = $this->model_barang->whereIn('id_barang', $id_barang)->findAll();

        // jika qty melebihi stok maka tidak bisa checkout
        foreach ($produk as $p) {
            $cart_qty = $cart[$p['id_barang']]['qty'];
            if ($cart_qty > $p['stok']) {
                $id_barang = $p['id_barang'];
                $nama_barang = $p['nama'];
                $stok = $p['stok'];
                session()->setFlashdata('error', "Stok $nama_barang tidak mencukupi, stok tersisa $stok");

                return redirect()->to('/cart');
            }
        }

        foreach ($produk as $p) {
            $cart_qty = $cart[$p['id_barang']]['qty'];
            $new_stock = $p['stok'] - $cart_qty;
            $this->model_barang->update($p['id_barang'], ['stok' => $new_stock]);
        }


        $this->model_jual->insert_data_jual($data_jual);

        return redirect()->to('/cart');
    }
}
