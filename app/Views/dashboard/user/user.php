<?= $this->extend('dashboard/user/layout_user') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="container">
        <h1>Welcome to your Dashboard, <?= session()->get('username') ?>!</h1>
        <img src="<?= base_url('images/tamnel1.png') ?>" alt="Gambar" style="width: 100%; height: auto; max-height: 600px; object-fit: cover; display: block;">

</section>

<?= $this->endSection() ?>
