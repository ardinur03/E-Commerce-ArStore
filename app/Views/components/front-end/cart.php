<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h1>keranjang</h1>
        </div>
        <div class="col-md-5">
            <?= session()->has('cart') ? '<h1>checkout</h1>' : '' ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="row">
                <!-- cek apakah ada session cart maka munculkan-->
                <?php
                // echo '<pre>';
                // print_r(session()->get('cart'));
                // echo '</pre>';

                ?>
                <?php if (session()->has('cart')) { ?>
                    <?php foreach (session('cart') as $item) : ?>
                        <div class="col-md-12  mt-2">
                            <div class="card border rounded shadow">
                                <div class="card-body d-flex align-items-start justify-content-lg-start align-items-lg-start">
                                    <div class="table-responsive text-start" style="margin-left: 11px;">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3">
                                                        <picture><img class="img-thumbnail" src="<?= base_url('gambar/' . $item['gambar'] . '') ?>" style="max-height: 144px;max-width: 100px;"></picture>
                                                    </td>
                                                    <td>Produk</td>
                                                    <td colspan="3"><strong><span style="color: inherit;"><?= $item['name'] ?>&nbsp;</span></strong></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td rowspan="2">
                                                        <form action="<?= base_url('delete_product_in_cart') ?>" method="post" id="form-delete-product-in-cart">
                                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                            <button type="submit" class="btn btn-outline-danger btn-sm border rounded-pill shadow" data-bs-toggle="tooltip" data-bss-tooltip="" type="button" title="Hapus Produk">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Harga (1)</td>
                                                    <td colspan="7">Rp<?= number_format($item['price'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="d-xl-flex justify-content-xl-start align-items-xl-end">Qty</td>
                                                    <td class="text-start" colspan="2">
                                                        <button onclick="update_qty_cart(<?= $item['id']  ?>, 'decrement')" class="btn btn-outline-primary btn-sm fs-2 fw-semibold border rounded-pill" type="button" style="margin-right: 10px;">-</button>
                                                        <span id="qty_produk_<?= $item['id'] ?>"><?= $item['qty'] ?></span>
                                                        <button onclick="update_qty_cart(<?= $item['id']  ?>, 'increment')" class="btn btn-outline-primary btn-sm fs-4 fw-semibold border rounded-pill" type="button" style="margin-left: 10px;">+</button>&nbsp;
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <p class="text-center">Keranjang Kosong</p>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-5">
            <?php if (session()->has('cart')) { ?>
                <div class="card border rounded shadow p-4">
                    <form action="<?= base_url('checkout') ?>" method="POST">
                        <div class="row g-3">

                            <!-- alert error checkout -->
                            <?php if (session()->has('error')) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> <?= session('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama-lengkap" placeholder="Nama Lengkap ..." required>
                            </div>
                            <div class="col-12">
                                <label for="no-hp" class="form-label">No Hp</label>
                                <input type="text" name="no_hp" class="form-control" id="no-hp" placeholder="+62 ..." required>
                            </div>
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" cols="30" rows="3" placeholder="Alamat ..." required></textarea>
                            </div>

                            <!-- kota dan kecamatan -->
                            <div class="col-md-6">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota ..." required>
                            </div>

                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan ..." required>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="col-md-12 mt-5 mb-3">
                            <div class="table-responsive text-start" style="margin-left: 11px;">
                                <?php if (session()->has('cart')) { ?>
                                    <!-- table produk dengan qty -->
                                    <table class="table table-sm">
                                        <thead class="table-primary">
                                            <tr>
                                                <th colspan="3">Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: small;">
                                            <?php
                                            foreach (session('cart') as $item) : ?>
                                                <tr>
                                                    <td><?= $item['name'] ?></td>
                                                    <td>Rp<?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>,00,-</td>
                                                    <td><?= $item['qty'] ?> x</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                <?php } ?>

                                <!-- header sub total -->
                                <table class="table table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th colspan="2">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: small;">
                                        <?php
                                        $total = 0;
                                        if (session()->has('cart')) {
                                            foreach (session('cart') as $item) {
                                                $total += $item['price'] * $item['qty'];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>Rp<?= number_format($total, 0, ',', '.') ?>,00,-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-4">

                        <!-- input hidden -->
                        <input type="hidden" name="total_transaksi" value="<?= $total ?>">

                        <button class="w-100 btn btn-outline-primary py-4" type="submit">checkout</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    async function update_qty_cart(id, type) {
        let qty = document.getElementById('qty_produk_' + id).innerHTML;
        let stok_barang = await get_stok_barang(id);
        console.log(stok_barang, 'sas', qty);
        if (type === 'increment') {
            if (qty < parseInt(stok_barang)) {
                qty = parseInt(qty) + 1;
                let url = 'http://localhost:8080/update_qty_cart';

                let data = {
                    id: id,
                    qty: qty
                }

                await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Stok Barang Tidak Mencukupi',
                })
            }
        } else if (type === 'decrement') {
            if (qty > 1) {
                qty--;
            }
        }

        document.getElementById('qty_produk_' + id).innerHTML = qty;
    }


    async function get_stok_barang(id) {
        let stok = 0;
        let url = 'http://localhost:8080/api/barang/'
        await fetch(url + id)
            .then(response => response.json())
            .then(data => {
                stok = data.stok;
            });

        return stok;
    }
</script>