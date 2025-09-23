<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanduanController extends Controller
{
    // Tampilkan halaman panduan
    public function index()
    {
        return view('panduan'); // nanti bikin view panduan.blade.php
    }
}
