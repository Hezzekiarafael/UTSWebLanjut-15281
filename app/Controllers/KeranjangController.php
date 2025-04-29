<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KeranjangController extends BaseController
{
    public function index()
    {
        $keranjang = session()->get('keranjang') ?? []; //	Mengambil data dari session (isi keranjang)
        return view('keranjang', ['keranjang' => $keranjang]);
    }
    
    public function tambah($kategori)
    {
        $produkList = [
            'buku-pelajaran' => ['nama' => 'Seni Budaya'],
            'sejarah' => ['nama' => 'Kemunculan Komunisme Indonesia'],
            'dongeng' => ['nama' => 'Timun Mas'],
            'komik' => ['nama' => 'Doraemon Vol.20'],
            'horror' => ['nama' => 'Horor Tanah Jawa'],
        ];
    
        $kategori = strtolower($kategori);
        
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

        session()->set('keranjang', $keranjang); // Menyimpan data ke dalam session (menambahkan produk ke keranjang)
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function hapus($index)
    {
        $keranjang = session()->get('keranjang') ?? [];
        
        if (isset($keranjang[$index])) {
            unset($keranjang[$index]);
            session()->set('keranjang', array_values($keranjang)); // Re-index array
            return redirect()->to('/keranjang')->with('success', 'Produk dihapus dari keranjang');
        }
        
        return redirect()->to('/keranjang')->with('error', 'Produk tidak ditemukan');
    }

    public function clear()
    {
        session()->remove('keranjang');
        return redirect()->to('/keranjang')->with('success', 'Keranjang berhasil dikosongkan');
    }
}