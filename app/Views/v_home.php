<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <?= $this->include('components/front-end/navbar') ?>
    <?= $this->include('components/front-end/carausel') ?>
    <?= $this->include('components/front-end/product', ['barang' => $barang]) ?>
<?= $this->endSection() ?>