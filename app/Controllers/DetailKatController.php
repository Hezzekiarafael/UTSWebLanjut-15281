<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DetailKatController extends Controller
{
    public function detail($nama_kategori)
    {
        // Decode URL dan ubah jadi slug (spasi → strip, huruf kecil)
        $slug = strtolower(str_replace(' ', '-', urldecode($nama_kategori)));

        $data['kategori'] = $slug;

        return view('v_detail_kategori', $data);
    }
}
