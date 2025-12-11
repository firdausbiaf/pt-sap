<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Data;
use App\Models\Legalitas;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        // $legalitasCounts = DB::table('legalitas')
        //     ->select(DB::raw('MONTH(tgl_masuk) as month'), DB::raw('COUNT(*) as count'))
        //     ->groupBy(DB::raw('MONTH(tgl_masuk)'))
        //     ->get();
        $tglmasukCounts = DB::table('legalitas')
            ->select(DB::raw('MONTH(tgl_masuk) as month'),
                     DB::raw('COUNT(tgl_masuk) as count_tgl_masuk'))
            ->groupBy(DB::raw('MONTH(tgl_masuk)'))
            ->get();
        $tglkeluarCounts = DB::table('legalitas')
            ->select(DB::raw('MONTH(tgl_keluar) as month'),
                     DB::raw('COUNT(tgl_keluar) as count_tgl_keluar'))
            ->groupBy(DB::raw('MONTH(tgl_keluar)'))
            ->get();
        
        $member = User::where('role', 'member');
        $admin = User::where('role', 'admin');
        $petugas = User::where('role', 'petugas');
        $data = Data::all();
        $legalitas = Legalitas::all();
        $course = Course::all();
        $category = Category::all();
        return view('dashboard.index', [
            'transaksi' => $transaksi,
            'member' => $member,
            'admin' => $admin,
            'petugas' => $petugas,
            'data' => $data,
            'legalitas' => $legalitas,
            'course' => $course,
            'category' => $category,
            'tglmasukCounts' => $tglmasukCounts,
            'tglkeluarCounts' => $tglkeluarCounts,
        ]);
    }
}
