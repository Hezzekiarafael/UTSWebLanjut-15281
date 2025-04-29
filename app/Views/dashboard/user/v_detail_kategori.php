<?= $this->extend('dashboard/user/layout_user') ?>
<?= $this->section('content') ?>

<div class="container" style="text-align: center; margin-top: 20px;">

    <!-- ✅ PESAN Produk Berhasil Ditambahkan -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; font-weight: bold; margin-bottom: 15px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php
        // Normalisasi ke huruf kecil
        $kategori = strtolower($kategori);

        // Data produk dummy
        $produk = [
            'buku-pelajaran' => ['nama' => 'Seni Budaya', 'gambar' => 'seni.png'],
            'sejarah' => ['nama' => 'Kemunculan Komunisme Indonesia', 'gambar' => 'bukusjr.png'],
            'dongeng' => ['nama' => 'Timun Mas', 'gambar' => 'timunmas.png'],
            'komik' => ['nama' => 'Doraemon Vol.20', 'gambar' => 'bkkomik.png'],
            'horror' => ['nama' => 'Horor Tanah Jawa', 'gambar' => 'bkhoror.png'],
        ];
    ?>
    
    <!-- ✅ Cek apakah kategori tersedia -->
    <?php if (isset($produk[$kategori])): ?> 
        <div style="margin-top: 30px;">
            <img src="<?= base_url('images/produk/' . $produk[$kategori]['gambar']) ?>" 
                 alt="<?= esc($produk[$kategori]['nama']) ?>" 
                 style="width: 200px; height: auto;">
            <p style="margin-top: 10px; font-weight: bold;"><?= esc($produk[$kategori]['nama']) ?></p>

            <a href="<?= base_url('keranjang/tambah/' . $kategori) ?>"
   class="btn btn-success" 
   style="margin-top: 10px; padding: 10px 15px; border-radius: 5px; display: inline-block;">
    🛒 Tambah ke Keranjang
</a>


        </div>
    <?php else: ?>
        <p>Kategori tidak ditemukan.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
