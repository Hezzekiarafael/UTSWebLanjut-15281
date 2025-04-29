<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProdukController extends Controller
{
    public function produk()
    {
        $data['kat'] = [
            'Buku Pelajaran',
            'Sejarah',
            'Dongeng',
            'Komik',
            'Horror'
        ];

        return view('produk', $data);
    }
    
}
