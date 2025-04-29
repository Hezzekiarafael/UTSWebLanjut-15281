<!-- dashboard/admin/tambah_produk.php -->
<?= $this->extend('dashboard/admin/layout_admin') ?>
<?= $this->section('content') ?>

<h1>Tambah Produk</h1>

<form method="POST" action="<?= site_url('/dashboard/admin/simpanProdukAdmin') ?>">
    <div>
        <label for="nama">Nama Produk</label>
        <input type="text" id="nama" name="nama" required>
    </div>

    <div>
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" required>
            <option value="Buku Pelajaran">Snack</option>
            <option value="Sejarah">Makanan</option>
            <option value="Dongeng">Minuman</option>
            <option value="Komik">Bumbu Dapur</option>
            <option value="Horor">Alat Tulis</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
