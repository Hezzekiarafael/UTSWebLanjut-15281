<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'dashboard/admin/admin') ? "" : "collapsed" ?>" href="<?= base_url('dashboard/admin/admin') ?>">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <?php if (session()->get('role') == 'admin') { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'dashboard/admin/produk') ? "" : "collapsed" ?>" href="<?= base_url('dashboard/admin/produk') ?>">
                    <i class="bi bi-receipt"></i>
                    <span>Edit Buku</span>
                </a>
            </li><!-- End Produk Nav -->
        <?php } ?>

    </ul>  
</aside><!-- End Sidebar-->
