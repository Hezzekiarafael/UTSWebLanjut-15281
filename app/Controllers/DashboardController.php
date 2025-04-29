<?php
// Mulai kerangka dasar AuthController dan DashboardController sesuai flow

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
{
    $session = session();
    if (!$session->get('logged_in')) {
        return redirect()->to('/login');
    }
    return view('dashboard/user/home');
}

    // DASHBOARD CONTROLLER ADMIN
    public function admin()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        if ($session->get('role') != 'admin') {
            return redirect()->to('/user');
        }
        return view('dashboard/admin/admin');
    }
    

    public function loginHistory()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
    
        $logins = $session->get('login_history');
        if (!$logins) {
            return redirect()->to('/login');
        }
        var_dump($logins); // (seharusnya ini gak perlu, atau dipindah kalau buat debugging)
        return view('dashboard/admin/login_history', ['logins' => $logins ?? []]);
    }
    
  public function produkAdmin()
{
    // Data produk disimpan di session
    $session = session();
    $produk = $session->get('produk') ?? [
        ['id' => 1, 'nama' => 'Produk 1', 'kategori' => 'Snack', 'harga' => 10000],
        ['id' => 2, 'nama' => 'Produk 2', 'kategori' => 'Minuman', 'harga' => 15000],
        ['id' => 3, 'nama' => 'Produk 3', 'kategori' => 'Makanan', 'harga' => 20000],
    ];

    $data['produk'] = $produk;
    $data['kat'] = [
        'Buku Pelajaran',
        'Sejarah',
        'Dongeng',
        'Komik',
        'Horror'
    ];

    return view('dashboard/admin/produk', $data);
}

public function tambahProdukAdmin()
{
    return view('dashboard/admin/tambah_produk');
}


public function editProdukAdmin($id)
{
    $session = session();
    $produk = $session->get('produk') ?? [];

    $produkYangDiedit = array_filter($produk, fn($p) => $p['id'] == $id);
    $data['produk'] = reset($produkYangDiedit); // Ambil produk yang sesuai ID

    return view('dashboard/admin/edit_produk', $data);
}

public function updateProdukAdmin($id)
{
    $session = session();
    $produk = $session->get('produk') ?? [];

    foreach ($produk as &$item) {
        if ($item['id'] == $id) {
            $item['nama'] = $this->request->getPost('nama');
            $item['kategori'] = $this->request->getPost('kategori');
        }
    }

    $session->set('produk', $produk);
    return redirect()->to('/dashboard/admin/produk');
}


public function hapusProdukAdmin($id)
{
    $session = session();
    $produk = $session->get('produk') ?? [];

    $produk = array_filter($produk, fn($p) => $p['id'] != $id);
    $session->set('produk', $produk);

    return redirect()->to('/dashboard/admin/produk');
}

public function simpanProdukAdmin()
{
    // Ambil data produk yang dikirimkan lewat POST
    $produkBaru = [
        'id' => time(),  // Gunakan timestamp sebagai ID unik produk
        'nama' => $this->request->getPost('nama'),
        'kategori' => $this->request->getPost('kategori'),
    ];

    // Validasi data produk yang dikirimkan
    if (!$this->validate([
        'nama' => 'required',
        'kategori' => 'required',
    ])) {
        // Jika validasi gagal, kembali ke form dengan input yang sudah ada
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Ambil data produk yang ada di session
    $session = session();
    $produk = $session->get('produk') ?? [];

    // Tambahkan produk baru ke dalam array produk
    $produk[] = $produkBaru;

    // Simpan kembali produk yang telah diperbarui ke session
    $session->set('produk', $produk);

    // Redirect ke halaman produk dengan pesan sukses
    return redirect()->to('/dashboard/admin/produk')->with('message', 'Produk berhasil ditambahkan!');
}



    // TAMBAH PRODUK DETAIL KAT ============================
    public function detailKategoriAdmin($nama_kategori)
    {
    // Normalisasi nama kategori (spasi → strip → huruf kecil)
    $slug = strtolower(str_replace(' ', '-', urldecode($nama_kategori)));

    $session = session();
    $produk_per_kategori = $session->get('produk_per_kategori') ?? [];

    // Kirimkan data kategori dan produk
    $data = [
        'kategori' => $slug,
        'produk' => $produk_per_kategori[$slug] ?? [],  // Kalau ada produk di kategori itu
    ];

    return view('dashboard/admin/v_detail_kategori', $data);
    }
    public function simpanProdukKategori($kategori)
    {
        $session = session();
        $produk = $session->get('produk_per_kategori') ?? [];

        // Validasi input
        if (!$this->validate([
            'nama_produk' => 'required',
            'gambar_produk' => 'uploaded[gambar_produk]|max_size[gambar_produk,2048]|is_image[gambar_produk]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama_produk = $this->request->getPost('nama_produk');
        $file = $this->request->getFile('gambar_produk');

        if ($file->isValid() && !$file->hasMoved()) {
            $nama_gambar = $file->getRandomName();
            $file->move('images/produk', $nama_gambar);
        } else {
            $nama_gambar = 'default.png';
        }

        // Tambah produk ke kategori
        $produk[strtolower($kategori)][] = [
            'id' => time(),
            'nama' => $nama_produk,
            'gambar' => $nama_gambar,
        ];

        // Simpan kembali ke session
        $session->set('produk_per_kategori', $produk);

        return redirect()->to('/dashboard/admin/detailKategoriAdmin/' . urlencode($kategori))->with('success', 'Produk berhasil ditambahkan!');
    }

    public function hapusProdukKategori($kategori, $id)
{
    $session = session();
    $produk_per_kategori = $session->get('produk_per_kategori') ?? [];

    // Cek apakah kategori ada
    if (isset($produk_per_kategori[$kategori])) {
        // Filter produk berdasarkan id
        $produk_per_kategori[$kategori] = array_filter($produk_per_kategori[$kategori], function ($produk) use ($id) {
            return $produk['id'] != $id;
        });

        // Reindex array untuk menjaga urutan array tetap benar setelah dihapus
        $produk_per_kategori[$kategori] = array_values($produk_per_kategori[$kategori]);

        // Jika kategori menjadi kosong, pastikan kategori tetap ada
        if (empty($produk_per_kategori[$kategori])) {
            // Pastikan kategori tidak dihapus, tetap ada dalam session dengan array kosong
            $produk_per_kategori[$kategori] = [];
        }

        // Simpan kembali ke session
        $session->set('produk_per_kategori', $produk_per_kategori);

        // Redirect dengan pesan sukses
        return redirect()->to('/dashboard/admin/detailKategoriAdmin/' . urlencode($kategori))->with('success', 'Produk berhasil dihapus!');
    }

    // Jika kategori tidak ditemukan
    return redirect()->to('/dashboard/admin/detailKategoriAdmin/' . urlencode($kategori))->with('error', 'Produk tidak ditemukan!');
}






    // END


    // DASHBOARD CONTROLLER USER
    public function userDashboard()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        if ($session->get('role') != 'user') {
            return redirect()->to('/admin');
        }
        return view('dashboard/user/user');
    }
    
    public function produk()
    {
            $data['kat'] = [
                'Buku Pelajaran',
                'Sejarah',
                'Dongeng',
                'Komik',
                'Horror'
            ];

        return view('dashboard/user/produk',$data);  // Pastikan tampilan produk di dalam dashboard
    }


    public function detailKategori($nama_kategori)

    {
        // Decode URL dan ubah jadi slug (spasi → strip, huruf kecil)
        $slug = strtolower(str_replace(' ', '-', urldecode($nama_kategori)));

        $data['kategori'] = $slug;

        return view('dashboard/user/v_detail_kategori', $data);  // Menampilkan detail kategori di dalam dashboard
    }


    public function keranjang()
    {
        $keranjang = session()->get('keranjang') ?? []; // Mengambil data keranjang dari session
        return view('dashboard/user/keranjang', ['keranjang' => $keranjang]);  // Tampilkan keranjang dalam dashboard
    }

    public function tambahKeranjang($kategori)
    {
        $produkList = [
            'buku-pelajaran' => ['nama' => 'Seni Budaya'],
            'sejarah' => ['nama' => 'Kemunculan Komunisme Indonesia'],
            'dongeng' => ['nama' => 'Timun Mas'],
            'komik' => ['nama' => 'Doraemon Vol.20'],
            'horror' => ['nama' => 'Horor Tanah Jawa'],
        ];

        $kategori = strtolower($kategori);

        // Validasi apakah kategori produk ada
        if (!array_key_exists($kategori, $produkList)) {
            return redirect()->back()->with('error', 'Kategori produk tidak valid!');
        }

        $keranjang = session()->get('keranjang') ?? [];

        // Cek apakah produk sudah ada di keranjang
        $found = false;
        foreach ($keranjang as &$item) {
            if ($item['kategori'] === $kategori) {
                $item['qty']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $keranjang[] = [
                'nama' => $produkList[$kategori]['nama'],
                'kategori' => $kategori,
                'qty' => 1,
            ];
        }

        session()->set('keranjang', $keranjang); // Menyimpan data ke dalam session
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function hapusKeranjang($index)
    {
        $keranjang = session()->get('keranjang') ?? [];

        if (isset($keranjang[$index])) {
            unset($keranjang[$index]);
            session()->set('keranjang', array_values($keranjang)); // Re-index array setelah dihapus
            return redirect()->to('/dashboard/user/keranjang')->with('success', 'Produk dihapus dari keranjang');
        }

        return redirect()->to('/dashboard/user/keranjang')->with('error', 'Produk tidak ditemukan');
    }

    public function clearKeranjang()
    {
        session()->remove('keranjang');
        return redirect()->to('/dashboard/user/keranjang')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
