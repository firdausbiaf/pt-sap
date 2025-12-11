<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpark;
use App\Http\Requests\StoreDparkRequest;
use App\Http\Requests\UpdateDparkRequest;

class DparkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusterOptions = ['ALEXANDRIA','SEVILLA','ANDALUSIA', 'GRANADA'];
        $clusterData = [];

        foreach ($clusterOptions as $cluster) {
            $clusterData[$cluster] = Dpark::where('cluster', $cluster)
                ->orderBy('id', 'asc')
                ->paginate(10);
        }

        return view('dashboard.dpark.index', compact('clusterOptions', 'clusterData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dpark = Dpark::whereNotIn('role', ['admin', 'petugas'])->select('id', 'name')->get();
        $clusterOptions = ['ALEXANDRIA','SEVILLA','ANDALUSIA', 'GRANADA'];
        return view('dashboard.dpark.create', compact('clusterOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDparkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDparkRequest $request)
    {
        try {
            $request->validate([
                'cluster' => 'required',
                'kavling' => 'required',
                'keterangan' => 'required',
            ]);
    
            $dpark = new Dpark;
            $dpark->cluster = $request->input('cluster');
            $dpark->kavling = $request->input('kavling');
            $dpark->keterangan = $request->input('keterangan');
    
            $dpark->save();
    
            return redirect()->route('stok-dpark.index')->with('success', 'Data baru telah ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Debug pesan kesalahan
            // Handle exception, if necessary
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dpark  $dpark
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dpark = Dpark::findOrFail($id);
        return view('dashboard.dpark.show', compact('dpark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dpark  $dpark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the data to be edited
        $dpark = Dpark::findOrFail($id);

        // Enum values for 'cluster'
        $clusterOptions = ['ALEXANDRIA','SEVILLA','ANDALUSIA', 'GRANADA'];

        return view('dashboard.dpark.edit', compact('dpark', 'clusterOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDparkRequest  $request
     * @param  \App\Models\Dpark  $dpark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDparkRequest $request, $id)
    {
        try {
            $request->validate([
                'cluster' => 'required',
                'kavling' => 'required',
                'keterangan' => 'required',
            ]);
    
            $dpark = Dpark::findOrFail($id);
            $dpark->cluster = $request->input('cluster');
            $dpark->kavling = $request->input('kavling');
            $dpark->keterangan = $request->input('keterangan');
    
            $dpark->save(); // Save the data after updating fields
    
            return redirect()->route('stok-dpark.index')->with('success', 'Data berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('stok-dpark.edit', $id)->with('error', 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dpark  $dpark
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dpark = Dpark::findOrFail($id);
        $dpark->delete();

        return redirect()->route('stok-dpark.index')->with('success', 'Data berhasil dihapus');
    }

    public function soldDpark(Request $request, Dpark $dpark)
    {

        $dpark = Dpark::findOrFail($request->id);
        if ($dpark) {
            $dpark->status = '1';
            $dpark->save();
        }

        return redirect('/admin/stok-dpark');
    }

    public function openDpark(Request $request)
    {

        $dpark = Dpark::findOrFail($request->id);
        if ($dpark) {
            $dpark->status = '0';
            $dpark->save();
        }

        return redirect('/admin/stok-dpark');
    }
}
