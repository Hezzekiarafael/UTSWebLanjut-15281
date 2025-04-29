<!-- dashboard/admin/edit_produk.php -->
<?= $this->extend('dashboard/admin/layout_admin') ?>
<?= $this->section('content') ?>

<h1>Edit Produk</h1>

<form method="POST" action="<?= site_url('/dashboard/admin/updateProdukAdmin/' . $produk['id']) ?>">
    <div>
        <label for="nama">Nama Produk</label>
        <input type="text" id="nama" name="nama" value="<?= $produk['nama'] ?>" required>
    </div>

    <div>
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" required>
            <option value="Buku Pelajaran" <?= $produk['kategori'] == 'Buku Pelajaran' ? 'selected' : '' ?>>Buku Pelajaran</option>
            <option value="Sejarah" <?= $produk['kategori'] == 'Sejarah' ? 'selected' : '' ?>>Sejarah</option>
            <option value="Dongeng" <?= $produk['kategori'] == 'Dongeng' ? 'selected' : '' ?>>Dongeng</option>
            <option value="Komik" <?= $produk['kategori'] == 'Komik' ? 'selected' : '' ?>>Komik</option>
            <option value="Horor" <?= $produk['kategori'] == 'Horor' ? 'selected' : '' ?>>Horor</option>
        </select>
    </div>
    <button type="submit">Update</button>
</form>

<?= $this->endSection() ?>
