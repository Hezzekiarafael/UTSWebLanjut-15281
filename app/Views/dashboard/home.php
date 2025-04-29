
<?php
// File: app/Views/dashboard/home.php
?>
<?= view('partials/header') ?>
<?= view('partials/navbar') ?>

<div class="container mt-4">
    <h1 class="text-center">Semua Buku</h1>
    <div class="row">
        <!-- Dummy buku -->
        <?php for($i=1; $i<=6; $i++): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buku <?= $i ?></h5>
                        <p class="card-text">Deskripsi singkat buku <?= $i ?>.</p>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

<?= view('partials/footer') ?>