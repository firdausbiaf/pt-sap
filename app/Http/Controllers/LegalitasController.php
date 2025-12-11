<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legalitas;
use App\Http\Requests\StoreLegalitasRequest;
use App\Http\Requests\UpdateLegalitasRequest;
use App\Models\Data;

class LegalitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legalitas = Legalitas::select("*")->orderBy("id", "asc")->paginate(10);
        $data = Data::pluck('kavling', 'id');

        return view('dashboard.legalitas.index', compact('legalitas', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Data::pluck('kavling', 'id');
        return view('dashboard.legalitas.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLegalitasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLegalitasRequest $request)
    {
        $request->validate([
            'data_id' => 'required',
            'nomor' => 'required',
            // 'uang_masuk' => 'required|integer',
            'tgl_masuk' => 'required|date',
            // 'uang_keluar' => 'required|integer',
            'tgl_keluar' => 'required|date',
            'keterangan' => 'required',
        ]);

        $legalitas = new Legalitas();
        $legalitas->data_id = $request->get('data_id');
        $legalitas->nomor = $request->get('nomor');
        // $legalitas->uang_masuk = $request->get('uang_masuk');
        $legalitas->tgl_masuk = $request->get('tgl_masuk');
        // $legalitas->uang_keluar = $request->get('uang_keluar');
        $legalitas->tgl_keluar = $request->get('tgl_keluar');
        $legalitas->keterangan = $request->get('keterangan');

        if ($legalitas->save()) {
            return redirect()->route('legalitas.index')->with('success', 'Data legalitas baru telah ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data legalitas. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Legalitas  $legalitas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $legalitas = Legalitas::findOrFail($id);
        return view('dashboard.legalitas.show', compact('legalitas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Legalitas  $legalitas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $legalitas = Legalitas::findOrFail($id);
        $data = Data::pluck('kavling', 'id');
        return view('dashboard.legalitas.edit', compact('legalitas', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLegalitasRequest  $request
     * @param  \App\Models\Legalitas  $legalitas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLegalitasRequest $request, $id)
    {
        $request->validate([
            'data_id' => 'required',
            'nomor' => 'required',
            // 'uang_masuk' => 'required|integer',
            'tgl_masuk' => 'required|date',
            // 'uang_keluar' => 'required|integer',
            'tgl_keluar' => 'required|date',
            'keterangan'=> 'required',
        ]);

        $legalitas = Legalitas::where('id', $id)->first();
        $legalitas->data_id = $request->get('data_id');
        $legalitas->nomor = $request->get('nomor');
        // $legalitas->uang_masuk = $request->get('uang_masuk');
        $legalitas->tgl_masuk = $request->get('tgl_masuk');
        // $legalitas->uang_keluar = $request->get('uang_keluar');
        $legalitas->tgl_keluar = $request->get('tgl_keluar');
        $legalitas->keterangan = $request->get('keterangan');
        $legalitas->save();

        return redirect()->route('legalitas.index')->with('success', 'Data legalitas berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Legalitas  $legalitas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $legalitas = Legalitas::findOrFail($id);
        $legalitas->delete();

        return redirect()->route('legalitas.index')->with('success', 'Data legalitas berhasil dihapus');
    }

    public function masuk_in(Request $request, Legalitas $legalitas)
    {

        $legalitas = Legalitas::findOrFail($request->id);
        if ($legalitas) {
            $legalitas->masuk = '0';
            $legalitas->save();
        }

        return redirect('/admin/legalitas');
    }

    public function masuk_out(Request $request)
    {

        $legalitas = Legalitas::findOrFail($request->id);
        if ($legalitas) {
            $legalitas->masuk = '1';
            $legalitas->save();
        }

        return redirect('/admin/legalitas');
    }
    public function keluar_in(Request $request, Legalitas $legalitas)
    {

        $legalitas = Legalitas::findOrFail($request->id);
        if ($legalitas) {
            $legalitas->keluar = '0';
            $legalitas->save();
        }

        return redirect('/admin/legalitas');
    }

    public function keluar_out(Request $request)
    {

        $legalitas = Legalitas::findOrFail($request->id);
        if ($legalitas) {
            $legalitas->keluar = '1';
            $legalitas->save();
        }

        return redirect('/admin/legalitas');
    }
}
