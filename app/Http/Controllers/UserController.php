<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Foto;
use App\Models\Promo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        if (Auth::user() && Auth::user()->role == "member") {
            $promo = Promo::all();
            $data = Data::where('user_id', Auth::id())->paginate(10);
            $kavlings = Data::where('user_id', Auth::id())->pluck('kavling', 'id');
            $foto = Foto::whereIn('data_id', $data->pluck('id'))->latest()->get();
            $video = Video::whereIn('data_id', $data->pluck('id'))->latest()->get();


            return view('user', [
                'promo' => $promo,
                'data' => $data,
                'kavlings' => $kavlings,
                'selectedKavlingId' => null,
                'foto' => $foto,
                'video' => $video,
            ]);
        }

        return view('user');
    }

    public function filter(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->role == "member") {
                $selectedKavlingId = $request->input('kavling');

                $data = Data::where('user_id', Auth::id());

                if ($selectedKavlingId) {
                    $data->where('id', $selectedKavlingId);
                }

                $data = $data->paginate(10);
                $foto = Foto::where('data_id', Auth::id())->get();
                $video = Video::whereIn('data_id', $data->pluck('id'))->latest()->get();
                $kavlings = Data::where('user_id', Auth::id())->pluck('kavling', 'id');

                return view('user', [
                    'data' => $data,
                    'foto' => $foto,
                    'video' => $video,
                    'kavlings' => $kavlings,
                    'selectedKavlingId' => $selectedKavlingId,
                ]);
            }
        }

        return view('user');
    }
}
