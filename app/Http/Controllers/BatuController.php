<?php

namespace App\Http\Controllers;

use App\Models\Batu;
use App\Http\Requests\StoreBatuRequest;
use App\Http\Requests\UpdateBatuRequest;
use Illuminate\Http\Request;

class BatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusterOptions = ['Tahap 1', 'Tahap 2', 'Tahap 3', 'Tahap 4'];
        $clusterData = [];

        foreach ($clusterOptions as $cluster) {
            $clusterData[$cluster] = Batu::where('cluster', $cluster)
                ->orderBy('id', 'asc')
                ->paginate(10);
        }

        return view('dashboard.batu.index', compact('clusterOptions', 'clusterData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clusterOptions = ['Tahap 1', 'Tahap 2', 'Tahap 3', 'Tahap 4'];
        return view('dashboard.batu.create', compact('clusterOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBatuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBatuRequest $request)
    {
        try {
            $request->validate([
                'cluster' => 'required',
                'kavling' => 'required',
                'keterangan' => 'required',
            ]);

            $batu = new Batu;
            $batu->cluster = $request->input('cluster');
            $batu->kavling = $request->input('kavling');
            $batu->keterangan = $request->input('keterangan');

            $batu->save();

            return redirect()->route('stok-batu.index')->with('success', 'Data baru telah ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Debug pesan kesalahan
            // Handle exception, if necessary
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batu = Batu::findOrFail($id);
        return view('dashboard.batu.show', compact('batu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batu = Batu::findOrFail($id);
        $clusterOptions = ['Tahap 1', 'Tahap 2', 'Tahap 3', 'Tahap 4'];
        return view('dashboard.batu.edit', compact('batu', 'clusterOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBatuRequest  $request
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBatuRequest $request, $id)
    {
        try {
            $request->validate([
                'cluster' => 'required',
                'kavling' => 'required',
                'keterangan' => 'required',
            ]);

            $batu = Batu::findOrFail($id);
            $batu->cluster = $request->input('cluster');
            $batu->kavling = $request->input('kavling');
            $batu->keterangan = $request->input('keterangan');

            $batu->save();

            return redirect()->route('stok-batu.index')->with('success', 'Data berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('stok-batu.edit', $id)->with('error', 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batu = Batu::findOrFail($id);
        $batu->delete();

        return redirect()->route('stok-batu.index')->with('success', 'Data berhasil dihapus');
    }

    public function soldBatu(Request $request, Batu $batu)
    {
        $batu = Batu::findOrFail($request->id);
        if ($batu) {
            $batu->status = '1';
            $batu->save();
        }

        return redirect('/admin/stok-batu');
    }

    public function openBatu(Request $request)
    {
        $batu = Batu::findOrFail($request->id);
        if ($batu) {
            $batu->status = '0';
            $batu->save();
        }

        return redirect('/admin/stok-batu');
    }
}
