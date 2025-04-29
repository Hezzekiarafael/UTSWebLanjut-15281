<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    .kategori-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 20px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .kategori-item {
        width: 100px;
        text-align: center;
    }

    .kategori-item img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        display: block;
        margin: 0 auto 10px;
    }

    .kategori-item a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    .kategori-item a:hover {
        color: #007bff;
    }
</style>

<ul class="kategori-container">
    <?php foreach ($kat as $value): //$kat berisi daftar kategori yang diambil dari controller ProdukController::produk()
        $slug = strtolower(str_replace(' ', '-', $value));
        $imagePath = base_url('images/icons/' . $slug . '.png');
        $link = base_url('kategori/' . $slug); 
    ?>
    <!--  merepresentasikan satu kategori (misalnya Snack, Makanan, dll).  -->
        <li class="kategori-item"> 
            <a href="<?= $link ?>">
                <img src="<?= $imagePath ?>" alt="<?= $value ?>"> 
                <div><?= $value ?></div>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?= $this->endSection() ?>
