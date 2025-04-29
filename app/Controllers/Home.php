<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
       return view('v_home');
    }
    
    public function kategori()
    {
        $data['kat'] = [
            'Snack',
            'Makanan',
            'Minuman',
            'Bumbu Dapur',
            'Alat Tulis'
        ];
    
        return view('produk', $data); // Pastikan ini benar
    }
}
