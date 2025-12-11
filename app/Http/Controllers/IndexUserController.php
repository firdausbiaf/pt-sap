<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexUserController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->first();
        $category = Category::all();

        return view('indexUser', [
            'category' => $category,
            'transaksi' => $transaksi,
            'course' => $transaksi->course,
        ]);
    }
}
