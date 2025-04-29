<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<?php
// Form input dari form helper CodeIgniter
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control',
    'placeholder' => 'Masukkan Username atau Email',
    'required' => true
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control',
    'placeholder' => 'Masukkan Password',
    'required' => true
];
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="<?= base_url('/') ?>" class="logo d-flex align-items-center w-auto">
                        <img src="<?= base_url() ?>NiceAdmin/assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">Book Store Hezz</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                            <p class="text-center small">Masukkan Username & Password untuk login</p>
                        </div>

                        <!-- ✅ Flashdata Error Login Gagal -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- ✅ Form Login -->
                        <?= form_open('login', ['class' => 'row g-3 needs-validation']) ?>

                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username / Email</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please enter your username/email.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <?= form_password($password) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="col-12">
                            <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary w-100']) ?>
                        </div>

                        <?= form_close() ?>

                    </div>
                </div>

                <div class="credits">
                    Designed by <a href="/">Mr.Hezz</a>
                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
