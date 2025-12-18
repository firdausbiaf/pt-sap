<?php

namespace App\Http\Controllers;

use App\Models\DurasiProyek;
use Illuminate\Http\Request;
use App\Models\Data;

class DurasiProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lokasiList = Data::pluck('lokasi')->unique();
        $durasiByLokasi = [];

        foreach ($lokasiList as $lokasi) {
            $durasiByLokasi[$lokasi] = DurasiProyek::whereHas('proyek', function ($q) use ($lokasi) {
                $q->where('lokasi', $lokasi);
            })->orderBy('id', 'asc')->get();
        }

        return view(
            'dashboard.durasi_proyek.index',
            compact('lokasiList', 'durasiByLokasi')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasiOptions = Data::pluck('lokasi')->unique();
        $kavlingOptions = [];

        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view(
            'dashboard.durasi_proyek.create',
            compact('lokasiOptions', 'kavlingOptions')
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'kavling' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // cari data (kavling)
        $data = Data::where('lokasi', $request->lokasi)
            ->where('kavling', $request->kavling)
            ->first();

        if (!$data) {
            return back()->with('error', 'Data kavling tidak ditemukan.');
        }

        // cegah duplikasi durasi
        if (DurasiProyek::where('data_id', $data->id)->exists()) {
            return back()->with('error', 'Durasi proyek untuk kavling ini sudah ada.');
        }

        DurasiProyek::create([
            'data_id' => $data->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()
            ->route('durasi-proyek.index')
            ->with('success', 'Durasi proyek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DurasiProyek  $durasiProyek
     * @return \Illuminate\Http\Response
     */
    public function show(DurasiProyek $durasiProyek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DurasiProyek  $durasiProyek
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $durasiProyek = DurasiProyek::findOrFail($id);

        $lokasiOptions = Data::pluck('lokasi')->unique();
        $kavlingOptions = [];

        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view(
            'dashboard.durasi_proyek.edit',
            compact('durasiProyek', 'lokasiOptions', 'kavlingOptions')
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DurasiProyek  $durasiProyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'kavling' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $durasiProyek = DurasiProyek::findOrFail($id);

        $data = Data::where('lokasi', $request->lokasi)
            ->where('kavling', $request->kavling)
            ->first();

        if (!$data) {
            return back()->with('error', 'Data kavling tidak ditemukan.');
        }

        $durasiProyek->update([
            'data_id' => $data->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()
            ->route('durasi-proyek.index')
            ->with('success', 'Durasi proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DurasiProyek  $durasiProyek
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $durasiProyek = DurasiProyek::findOrFail($id);
        $durasiProyek->delete();

        return redirect()
            ->route('durasi-proyek.index')
            ->with('success', 'Durasi proyek berhasil dihapus.');
    }

    /**
     * AJAX: get kavling by lokasi
     */

    public function getKavlingsByLocation(Request $request)
    {
        $kavlings = Data::where('lokasi', $request->lokasi)->pluck('kavling');
        return response()->json($kavlings);
    }
}
