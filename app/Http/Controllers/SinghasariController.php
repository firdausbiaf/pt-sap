<?php

namespace App\Http\Controllers;

use App\Models\Singhasari;
use App\Http\Requests\StoreSinghasariRequest;
use App\Http\Requests\UpdateSinghasariRequest;
use Illuminate\Http\Request;

class SinghasariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singhasaris = Singhasari::paginate(10);
    return view('dashboard.singhasari.index', compact('singhasaris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.singhasari.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSinghasariRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSinghasariRequest $request)
    {
        $request->validate([
            'kluster' => 'required',
            'kavling' => 'required',
            
            'keterangan' => 'required',
            
        ]);

        $singhasari = new Singhasari();
        $singhasari->kluster = $request->get('kluster');
        $singhasari->kavling = $request->get('kavling');
        // $singhasari->status = $request->get('status');
    
        $singhasari->keterangan = $request->get('keterangan');

        if ($singhasari->save()) {
            return redirect()->route('stok-singhasari.index')->with('success', 'Stok baru telah ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan Stok. Silakan coba lagi.');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Singhasari  $singhasari
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singhasari = Singhasari::findOrFail($id);
        return view('dashboard.singhasari.show', compact('singhasari'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Singhasari  $singhasari
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singhasari = Singhasari::findOrFail($id);
        return view('dashboard.singhasari.edit', compact('singhasari'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSinghasariRequest  $request
     * @param  \App\Models\Singhasari  $singhasari
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSinghasariRequest $request, Singhasari $singhasari)
    {
        $request->validate([
            'kluster' => 'required',
            'kavling' => 'required',
            'keterangan' => 'required',
        ]);

        $singhasari->kluster = $request->get('kluster');
        $singhasari->kavling = $request->get('kavling');
        $singhasari->keterangan = $request->get('keterangan');

        if ($singhasari->save()) {
            return redirect()->route('stok-singhasari.index')->with('success', 'Stok berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui Stok. Silakan coba lagi.');
        }
    } 
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Singhasari  $singhasari
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singhasari = Singhasari::findOrFail($id);
        $singhasari->delete();

        return redirect()->route('stok-singhasari.index')->with('success', 'Data berhasil dihapus');
    }

    public function soldSinghasari(Request $request, Singhasari $singhasari)
    {

        $singhasari = Singhasari::findOrFail($request->id);
        if ($singhasari) {
            $singhasari->status = '1';
            $singhasari->save();
        }

        return redirect('/admin/stok-singhasari');
    }

    public function openSinghasari(Request $request)
    {

        $singhasari = Singhasari::findOrFail($request->id);
        if ($singhasari) {
            $singhasari->status = '0';
            $singhasari->save();
        }

        return redirect('/admin/stok-singhasari');
    }
}
