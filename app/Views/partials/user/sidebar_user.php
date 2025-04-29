<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'dashboard/user/user') ? "" : "collapsed" ?>" href="<?= base_url('dashboard/user/user') ?>">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <?php if (session()->get('role') == 'user') { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'dashboard/user/produk') ? "" : "collapsed" ?>" href="<?= base_url('dashboard/user/produk') ?>">
                    <i class="bi bi-receipt"></i>
                    <span>Semua Buku</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'dashboard/user/keranjang') ? "" : "collapsed" ?>" href="<?= base_url('dashboard/user/keranjang') ?>">
                <i class="bi bi-cart-check"></i>
                <span>Buku Saya</span>
            </a>
        </li><!-- End Keranjang Nav -->

    </ul>  
</aside><!-- End Sidebar-->
