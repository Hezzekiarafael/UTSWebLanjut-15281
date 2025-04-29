<?= $this->extend('dashboard/admin/layout_admin') ?>
<?= $this->section('content') ?>

<div class="container" style="text-align: center; margin-top: 20px;">

    <!-- ✅ Pesan Flashdata -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; font-weight: bold; margin-bottom: 15px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- ✅ Tombol Tambah Produk -->
    <div>
        <form action="<?= base_url('dashboard/admin/simpanProdukKategori/' . $kategori) ?>" method="post" enctype="multipart/form-data" style="margin-bottom: 30px;">
            <input type="text" name="nama_produk" placeholder="Nama Produk" required>
            <input type="file" name="gambar_produk" required>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>

    <!-- ✅ List Produk -->
<?php if (!empty($produk)): ?>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <?php foreach ($produk as $item): ?>
            <div style="border: 1px solid #ddd; padding: 15px; width: 200px; text-align: center;">
                <img src="<?= base_url('images/produk/' . $item['gambar']) ?>" 
                     alt="<?= esc($item['nama']) ?>" 
                     style="width: 100%; height: auto;">
                <p style="margin-top: 10px; font-weight: bold;"><?= esc($item['nama']) ?></p>
                
                <!-- Tombol Hapus Produk -->
                <a href="<?= base_url('dashboard/admin/hapusProdukKategori/' . $kategori . '/' . $item['id']) ?>" 
                   class="btn btn-danger" 
                   style="margin-top: 10px; padding: 5px 15px; border-radius: 5px; display: inline-block;">
                   Hapus
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Belum ada produk di kategori ini.</p>
<?php endif; ?>


<?= $this->endSection() ?>
