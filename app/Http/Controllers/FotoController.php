<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Http\Requests\StoreFotoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Models\Data;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil semua data lokasi untuk membuat tab-tab
        $lokasiList = Data::pluck('lokasi')->unique();

        // Inisialisasi array untuk menyimpan foto-foto berdasarkan lokasi
        $fotosByLokasi = [];

        foreach ($lokasiList as $lokasi) {
            // Ambil data foto berdasarkan lokasi yang sesuai
            $fotos = Foto::whereHas('data', function ($dataQuery) use ($lokasi) {
                $dataQuery->where('lokasi', $lokasi);
            })->orderBy('id', 'asc')->get();

            $fotosByLokasi[$lokasi] = $fotos;
        }

        return view('dashboard.foto.index', compact('fotosByLokasi', 'lokasiList'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    // Ambil daftar lokasi dari model Data
    $lokasiOptions = Data::pluck('lokasi')->unique();

    // Inisialisasi array untuk menyimpan pilihan kavling berdasarkan lokasi
    $kavlingOptions = [];

    // Loop melalui setiap lokasi dan ambil pilihan kavling yang sesuai
    foreach ($lokasiOptions as $lokasi) {
        $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
    }

    return view('dashboard.foto.create', compact('lokasiOptions', 'kavlingOptions'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(StoreFotoRequest $request)
    {
        // Validasi form menggunakan StoreFotoRequest
        // Anda tidak perlu lagi melakukan validasi di sini karena sudah dilakukan di StoreFotoRequest

        // Ambil data_id berdasarkan lokasi dan kavling
        $data = Data::where('lokasi', $request->input('lokasi'))
            ->where('kavling', $request->input('kavling'))
            ->first();

        if (!$data) {
            return redirect()->route('foto.create')->with('error', 'Data kavling tidak ditemukan.');
        }

        $fotoPaths = []; // Simpan path file foto untuk setiap foto yang diunggah

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $nama_photo = $file->store('photo', 'public');
                $fotoPaths[] = $nama_photo;
            }
        }

        // Buat entri untuk setiap foto yang diunggah
        foreach ($fotoPaths as $nama_photo) {
            $foto = new Foto;
            $foto->data_id = $data->id;
            $foto->photo = $nama_photo;

            // Set nilai default untuk kolom "komplain" dan "status"
            $foto->komplain = null;
            $foto->status = 0;

            $foto->save();
        }

        return redirect()->route('foto.index')->with('success', 'Foto baru telah ditambahkan');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foto = Foto::findOrFail($id);
        return view('dashboard.foto.show', compact('foto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        // Ambil daftar lokasi dari model Data
        $lokasiOptions = Data::pluck('lokasi')->unique();

        // Inisialisasi array untuk menyimpan pilihan kavling berdasarkan lokasi
        $kavlingOptions = [];

        // Loop melalui setiap lokasi dan ambil pilihan kavling yang sesuai
        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view('dashboard.foto.edit', compact('foto', 'lokasiOptions', 'kavlingOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFotoRequest  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFotoRequest $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
            'kavling' => 'required',
            'photo' => 'image|file|max:10240',
            'komplain' => 'nullable|string', // Validasi komplain sebagai string opsional
            'status' => 'nullable|integer|between:0,1', // Validasi status sebagai integer antara 0 dan 1
        ]);

        $foto = Foto::findOrFail($id);

        // Ambil data_id berdasarkan lokasi dan kavling
        $data = Data::where('lokasi', $request->input('lokasi'))
            ->where('kavling', $request->input('kavling'))
            ->first();

        if (!$data) {
            return redirect()->route('foto.edit', $foto->id)->with('error', 'Data kavling tidak ditemukan.');
        }

        $foto->data_id = $data->id;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($foto->photo && file_exists(storage_path('app/public/' . $foto->photo))) {
                Storage::delete('public/' . $foto->photo);
            }
            $nama_photo = $request->file('photo')->store('photo', 'public');
            $foto->photo = $nama_photo;
        }

        // Set nilai untuk kolom "komplain" dan "status"
        $foto->komplain = $request->input('komplain');
        $foto->status = $request->input('status', 0); // Default value adalah 0 jika tidak disertakan

        $foto->save();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        if ($foto->photo && file_exists(storage_path('app/public/' . $foto->photo))) {
            Storage::delete('public/' . $foto->photo);
        }
        $foto->delete();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus');
    }


    public function filter(Request $request)
    {
        $selectedLokasi = $request->input('lokasi');
    
        $query = Foto::query();
    
        if ($selectedLokasi) {
            $query->whereHas('data', function ($dataQuery) use ($selectedLokasi) {
                $dataQuery->where('lokasi', $selectedLokasi);
            });
        }
    
        $fotos = $query->orderBy('id', 'asc')->paginate(10);
    
        // Get the data for the filter dropdown
        $lokasiOptions = Data::pluck('lokasi')->unique();
    
        return view('dashboard.foto.index', compact('fotos', 'lokasiOptions', 'selectedLokasi'));
    }

    public function getKavlingsByLocation(Request $request)
    {
        $lokasi = $request->input('lokasi');
        $kavlings = Data::where('lokasi', $lokasi)->pluck('kavling');
    
        // Perbaiki cara mengirimkan data kavling dalam format JSON
        return response()->json($kavlings);
    }

    public function getFotosByLocation(Request $request)
    {
        $lokasi = $request->input('lokasi');
        $fotos = Foto::whereHas('data', function ($dataQuery) use ($lokasi) {
            $dataQuery->where('lokasi', $lokasi);
        })->orderBy('id', 'asc')->get();

        // Perbaiki cara mengirimkan data foto dalam format JSON
        return response()->json($fotos);
    }

public function komplain_start(Request $request, Foto $foto)
    {

        $foto = Foto::findOrFail($request->id);
        if ($foto) {
            $foto->status = '1';
            $foto->save();
        }

        return redirect('/admin/foto');
    }

    public function komplain_finish(Request $request)
    {

        $foto = Foto::findOrFail($request->id);
        if ($foto) {
            $foto->status = '0';
            $foto->save();
        }

        return redirect('/admin/foto');
    }
    
}
