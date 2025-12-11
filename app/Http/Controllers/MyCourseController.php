<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Category;

class MyCourseController extends Controller
{
    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $category = Category::all();
        return view('MyCourse1', [
            'materi' => $transaksi->course->materi,
            'transaksi' => $transaksi,
            'category' => $category
        ]);
    }

    public function next($id){
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->progres = $transaksi->progres + 1;
        $transaksi->save();

        return redirect('/myCourse'.'/'.$id); 
    }

    public function reset($id){
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->progres = 0;
        $transaksi->save();

        return redirect('/courseMember'); 
    }

}
