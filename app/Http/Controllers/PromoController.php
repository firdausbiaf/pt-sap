<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $promos = Promo::paginate(10);
        $promo = Promo::all(); // Ambil semua data promo
    return view('dashboard.promo.index', compact('promos', 'promo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromoRequest $request)
    {
        $request->validate([
            'gambar' => 'required|image|max:10240',
            'keterangan' => 'required',
        ]);

        $gambarPath = $request->file('gambar')->store('promos', 'public');

        Promo::create([
            'gambar' => $gambarPath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('promo.index')->with('success', 'Promo baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = Promo::findOrFail($id);
        return view('dashboard.promo.show', compact('promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('dashboard.promo.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromoRequest  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoRequest $request, $id)
    {
        $request->validate([
            'gambar' => 'image|max:10240',
            'keterangan' => 'required',
        ]);

        $promo = Promo::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('promos', 'public');
            $promo->gambar = $gambarPath;
        }

        $promo->keterangan = $request->keterangan;
        $promo->save();

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);

        if ($promo->gambar && Storage::exists('public/' . $promo->gambar)) {
            Storage::delete('public/' . $promo->gambar);
        }

        $promo->delete();

        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus');
    }
}
