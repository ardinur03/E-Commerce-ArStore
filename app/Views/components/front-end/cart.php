<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h1>keranjang</h1>
        </div>
        <div class="col-md-5">
            <h1>checkout</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="row">
                <!-- cek apakah ada session cart maka munculkan-->
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
        <div class="col">
            <p class="text-center">Coming Soon</p>
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