<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use Illuminate\Support\Facades\Storage;




class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Data::select("*")->orderBy("id", "asc")->paginate(10);
        return view('dashboard.data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('role', ['admin', 'petugas'])->select('id', 'name')->get();
        // $lokasiOptions = ['DJAGAD LAND BATU', 'DJAGAD LAND SINGHASARI', 'DPARK CITY'];
        return view('dashboard.data.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataRequest $request)
{
    try {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kavling' => 'required',
            'lokasi' => 'required',
            'kluster' => 'required',
            'tipe' => 'required|integer',
            'spk' => 'required',
            'ptb' => 'required',
            'harga_deal' => 'required|integer',
            'progres' => 'required|integer',
            'sales' => 'required',
            // 'ktp' => 'required|array',
            'ktp.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = new Data;
        $data->user_id = $request->input('user_id');
        $data->kavling = $request->input('kavling');
        $data->lokasi = $request->input('lokasi');
        $data->kluster = $request->input('kluster');
        $data->tipe = $request->input('tipe');
        $data->spk = $request->input('spk');
        $data->ptb = $request->input('ptb');
        $data->harga_deal = $request->input('harga_deal');
        $data->progres = $request->input('progres');
        $data->sales = $request->input('sales');

        if ($request->hasFile('ktp')) {
            $uploadedKtpCount = count($request->file('ktp'));

            if ($uploadedKtpCount > 10) {
                return redirect()->back()->withErrors(['ktp' => 'Maximum 10 KTP photos are allowed.']);
            }

            $ktpPaths = [];
            foreach ($request->file('ktp') as $file) {
                $nama_ktp = $file->store('ktp', 'public');
                $ktpPaths[] = $nama_ktp;
            }
            $data->ktp = json_encode($ktpPaths); // Simpan array jalur file dalam bentuk JSON
        } 
        
        // else {
        //     $request->validate([
        //         'ktp' => 'required',
        //     ], ['ktp.required' => 'Mohon unggah setidaknya satu file KTP.']);

        //     return redirect()->back()->withInput()->withErrors(['ktp' => 'Mohon unggah setidaknya satu file KTP.']);
        // }

        $data->save();

        return redirect()->route('data.index')->with('success', 'Data baru telah ditambahkan');
    } catch (\Exception $e) {
        dd($e->getMessage()); // Debug pesan kesalahan
        // Handle exception, if necessary
    }
}


//         if ($request->hasFile('ktp')) {
//             $ktpPaths = [];
//             $uploadedKtpCount = count($request->file('ktp'));

//             // Check if the number of uploaded KTP photos exceeds 10
//             if ($uploadedKtpCount > 10) {
//                 return redirect()->back()->withErrors(['ktp' => 'Maximum 10 KTP photos are allowed.']);
//             }

//             foreach ($request->file('ktp') as $file) {
//                 $nama_ktp = $file->store('ktp', 'public');
//                 $ktpPaths[] = $nama_ktp;
//             }
//             $data->ktp = implode(',', $ktpPaths);
//         } else {
//             $request->validate([
//                 'ktp' => 'required',
//             ], ['ktp.required' => 'Mohon unggah setidaknya satu file KTP.']);

//             return redirect()->back()->withInput()->withErrors(['ktp' => 'Mohon unggah setidaknya satu file KTP.']);
//         }

//         $data->save();

//         // Redirect to index page with success message
//         return redirect()->route('data.index')->with('success', 'Data baru telah ditambahkan');
//     } catch (\Exception $e) {
//         dd($e->getMessage());
//         // Handle exception, if necessary
//     }
// }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::findOrFail($id);
        return view('dashboard.data.show', compact('data'));
    }

    public function viewKtp($id)
{
    try {
        $data = Data::findOrFail($id);
        return view('dashboard.data.view_ktp', compact('data'));
    } catch (\Exception $e) {
        return redirect()->route('data.index')->with('error', 'Terjadi kesalahan saat menampilkan KTP: ' . $e->getMessage());
    }
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the data to be edited
        $data = Data::findOrFail($id);

        // Get users with roles other than "admin"
        $users = User::whereNotIn('role', ['admin', 'petugas'])->select('id', 'name')->get();

        // Enum values for 'lokasi'
        $lokasiOptions = ['DJAGAD LAND BATU', 'DJAGAD LAND SINGHASARI', 'DPARK CITY'];

        return view('dashboard.data.edit', compact('data', 'users', 'lokasiOptions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataRequest  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataRequest $request, $id)
{
    try {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kavling' => 'required',
            'kluster' => 'required',
            'tipe' => 'required|integer',
            'spk' => 'required',
            'ptb' => 'required',
            'harga_deal' => 'required|integer',
            'progres' => 'required|integer',
            'sales' => 'required',
            'ktp.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'ktp' => 'max:10', // Batasi maksimal 10 foto KTP
        ], [
            'ktp.max' => 'Maximum 10 KTP photos are allowed.', // Pesan khusus jika jumlah melebihi 10
        ]);

        $data = Data::findOrFail($id);
        $data->user_id = $request->get('user_id');
        $data->kluster = $request->get('kluster');
        $data->kavling = $request->get('kavling');
        $data->lokasi = $request->get('lokasi');
        $data->tipe = $request->get('tipe');
        $data->harga_deal = $request->get('harga_deal');
        $data->spk = $request->get('spk');
        $data->ptb = $request->get('ptb');
        $data->progres = $request->get('progres');
        $data->sales = $request->get('sales');

        // Get existing KTP paths
        $existingKtpPaths = json_decode($data->ktp) ?? [];

        // Handle photo upload
        // if ($request->hasFile('ktp')) {
        //     $ktpPaths = [];
        //     foreach ($request->file('ktp') as $file) {
        //         $nama_ktp = $file->store('ktp', 'public');
        //         $ktpPaths[] = $nama_ktp;
        //     }

        //     // Merge existing KTP paths with new ones
        //     $ktpPaths = array_merge($existingKtpPaths, $ktpPaths);
        //     $data->ktp = implode(',', $ktpPaths);
        // }

        // $data->save();

        if ($request->hasFile('ktp')) {
            $ktpPaths = [];
            foreach ($request->file('ktp') as $file) {
                $nama_ktp = $file->store('ktp', 'public');
                $ktpPaths[] = $nama_ktp;
            }
        
            $ktpPaths = array_merge($existingKtpPaths, $ktpPaths);
            $data->ktp = json_encode($ktpPaths);
        } else {
            $data->ktp = json_encode($existingKtpPaths);
        }
        
        $data->save();

        return redirect()->route('data.index')->with('success', 'Data berhasil diedit');
    } catch (\Exception $e) {
        return redirect()->route('data.edit', $id)->with('error', 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }


    public function deletePhoto(Request $request)
    {
        try {
            $photoPath = $request->input('photoPath');
    
            // Hapus foto menggunakan Storage atau unlink
            Storage::delete('public/' . $photoPath); // Menggunakan Storage
    
            $data = Data::find($request->data_id); // Ganti Data dengan nama model yang sesuai
            $ktpPhotos = json_decode($data->ktp);
    
            // Hapus foto dari array
            $updatedKtpPhotos = array_diff($ktpPhotos, [$photoPath]);
            $data->ktp = json_encode(array_values($updatedKtpPhotos));
            $data->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    
    public function importExcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('data', $namafile);

        Excel::import(new DataImport, \public_path('/data/' . $namafile));
        return \redirect()->back();

        // $request->validate([
        //     'file' => 'required|mimes:xlsx,csv,ods'
        // ]);

        // // Lakukan import data dari file Excel
        // $data = Excel::import(new DataImport, $request->file('file'));

        // return redirect()->route('data.index')->with('success', 'Data berhasil diimpor dari Excel.');
    }

    public function search(Request $request)
{
    $search = $request->input('search'); // Ambil kata kunci pencarian dari input

    // Gunakan fitur pencarian hanya jika kata kunci pencarian ada
    if ($search) {
        $data = Data::select("*")
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('lokasi', 'LIKE', "%{$search}%")
                ->orWhere('kluster', 'LIKE', "%{$search}%")
                ->orWhere('kavling', 'LIKE', "%{$search}%")
                ->orWhere('sales', 'LIKE', "%{$search}%");
            })
            ->orderBy("id", "asc")
            ->paginate(10);
    } else {
        // Jika tidak ada kata kunci pencarian, tampilkan semua data seperti sebelumnya
        $data = Data::select("*")->orderBy("id", "asc")->paginate(10);
    }

    return view('dashboard.data.index', compact('data', 'search'));
}


}
