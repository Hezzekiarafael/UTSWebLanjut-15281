<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');


$routes->get('/', 'Home::index');
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']); // Dashboard umum


// ROUTES ADMIN
$routes->get('dashboard/admin/admin', 'DashboardController::admin', ['filter' => 'auth']); // Dashboard untuk admin
$routes->get('dashboard/admin/login_history', 'DashboardController::loginHistory', ['filter' => 'auth']);
$routes->get('dashboard/admin/produk', 'DashboardController::produkAdmin', ['filter' => 'auth']);  // Produk dalam dashboard
$routes->get('dashboard/admin/kategori/(:any)', 'DashboardController::detailKategoriAdmin/$1', ['filter' => 'auth']);  // Akses detail 
$routes->get('/dashboard/admin/tambah_produk', 'DashboardController::tambahProdukAdmin', ['filter' => 'auth']);
$routes->post('dashboard/admin/produk/simpan', 'DashboardController::simpanProdukAdmin', ['filter' => 'auth']);
$routes->get('dashboard/admin/edit_produk/(:num)', 'DashboardController::editProdukAdmin/$1', ['filter' => 'auth']);
$routes->post('dashboard/admin/produk/update/(:num)', 'DashboardController::updateProdukAdmin/$1', ['filter' => 'auth']);
$routes->get('dashboard/admin/produk/hapus/(:num)', 'DashboardController::hapusProdukAdmin/$1', ['filter' => 'auth']);
$routes->post('dashboard/admin/simpanProdukAdmin', 'DashboardController::simpanProdukAdmin', ['filter' => 'auth']);

// TAMBAH PRODUK
$routes->get('dashboard/admin/detailKategoriAdmin/(:segment)', 'DashboardController::detailKategoriAdmin/$1', ['filter' => 'auth']);
$routes->post('dashboard/admin/simpanProdukKategori/(:segment)', 'DashboardController::simpanProdukKategori/$1', ['filter' => 'auth']);
$routes->get('dashboard/admin/hapusProdukKategori/(:segment)/(:num)', 'DashboardController::hapusProdukKategori/$1/$2', ['filter' => 'auth']);




// ROUTES USER
$routes->get('dashboard/user/user', 'DashboardController::userDashboard', ['filter' => 'auth']); // Mengarah ke method userDashboard
$routes->get('dashboard/user/produk', 'DashboardController::produk', ['filter' => 'auth']);  // Produk dalam dashboard
$routes->get('dashboard/user/kategori/(:any)', 'DashboardController::detailKategori/$1', ['filter' => 'auth']);  // Akses detail kategori
$routes->get('dashboard/user/keranjang', 'DashboardController::keranjang', ['filter' => 'auth']);  // Keranjang dalam dashboard
$routes->get('dashboard/user/keranjang/tambah/(:any)', 'DashboardController::tambahKeranjang/$1', ['filter' => 'auth']);
$routes->get('dashboard/user/keranjang/hapus/(:num)', 'DashboardController::hapusKeranjang/$1', ['filter' => 'auth']);
$routes->get('dashboard/user/keranjang/clear', 'DashboardController::clearKeranjang', ['filter' => 'auth']);


// ROUTES GUEST

$routes->get('keranjang', 'KeranjangController::index');
$routes->get('keranjang/tambah/(:any)', 'KeranjangController::tambah/$1');
$routes->get('keranjang/clear', 'KeranjangController::clear');
$routes->get('produk', 'ProdukController::produk');
$routes->get('kategori/(:any)','DetailKatController::detail/$1');
