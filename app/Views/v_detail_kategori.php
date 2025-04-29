<?= $this->extend('layout') ?>
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

            <!-- ✅ Cek apakah user sudah login -->
            <?php if (session()->get('isLoggedIn') && session()->get('role') == 'admin'): ?>
                <!-- Kalau sudah login -->
                <a href="<?= base_url('keranjang/tambah/' . $kategori) ?>"
                   class="btn btn-success" 
                   style="margin-top: 10px; padding: 10px 15px; border-radius: 5px; display: inline-block;">
                    🛒 Tambah ke Keranjang
                </a>
            <?php else: ?>
                <!-- Kalau belum login -->
                <a href="<?= base_url('login') ?>"
                   class="btn btn-primary" 
                   style="margin-top: 10px; padding: 10px 15px; border-radius: 5px; display: inline-block;">
                    🔒 Login untuk Menambah ke Keranjang
                </a>
            <?php endif; ?>

        </div>
    <?php else: ?>
        <p>Kategori tidak ditemukan.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
