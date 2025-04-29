<?= $this->extend('dashboard/admin/layout_admin') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="container">
        <h1>Welcome Admin, <?= session()->get('username') ?>!</h1>
        <!-- <img src="<?= base_url('images/coba3.png') ?>" alt="Gambar" style="width: 100%; height: auto; max-height: 600px; object-fit: cover; display: block;"> -->
    
  <?= $this->include('dashboard/admin/login_history') ?>
</section>

<?= $this->endSection() ?>
