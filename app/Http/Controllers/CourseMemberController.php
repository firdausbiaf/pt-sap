<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Category;

class CourseMemberController extends Controller
{
    public function index()
    {
        return view('courseMember',[
            'transaksi'=> Transaksi::all(),
            'category' => Category::all()
        ]);
    }

    public function transaksi()
    {
        return view('transaksi',[
            'transaksi'=> Transaksi::all(),
            'category' => Category::all()
        ]);
    }
}
