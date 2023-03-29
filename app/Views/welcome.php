<section class="container mt-5">
    <table class="table table-striped">
        <thead class="bg-primary text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Nim</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr class="table-primary">
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['nim'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links('default', 'pagination') ?>
</section>

<section class="container mb-5 py-5">
    <div class="row mt-5">
        <div class="col-4">
            <form action="<?= base_url('post') ?>" method="post">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="Masukkan Nama">
                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="nim" class="form-label">Nim</label>
                    <input type="text" class="form-control <?= session('errors.nim') ? 'is-invalid' : '' ?>" id="nim" name="nim" value="<?= set_value('nim') ?>" placeholder="Masukkan Nim">
                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.nim') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>

        </div>
    </div>
</section>