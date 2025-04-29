<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (!session()->get('isLoggedIn') || session()->get('role') != 'user'): ?>
    <!-- Kalau belum login atau bukan user -->
    <div class="alert alert-warning">
        Anda harus login untuk melihat keranjang.
    </div>
<?php else: ?>
    <!-- Kalau sudah login sebagai user -->

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($keranjang)): ?>
        <p>Keranjang kamu kosong.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($keranjang as $index => $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= esc($item['nama']) ?> (<?= esc($item['kategori']) ?>)
                    <span class="badge bg-primary rounded-pill"><?= esc($item['qty']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <div class="mt-3">
            <a href="<?= base_url('keranjang/clear') ?>" class="btn btn-danger">Kosongkan Keranjang</a>
            <a href="<?= base_url('/produk') ?>" class="btn btn-primary">Lanjut Belanja</a>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?= $this->endSection() ?>
