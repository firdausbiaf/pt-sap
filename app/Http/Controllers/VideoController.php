<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Data;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lokasiList = Data::pluck('lokasi')->unique();
        $videosByLokasi = [];

        foreach ($lokasiList as $lokasi) {
            $videosByLokasi[$lokasi] = Video::whereHas('data', function ($q) use ($lokasi) {
                $q->where('lokasi', $lokasi);
            })->orderBy('id', 'asc')->get();
        }

        return view('dashboard.video.index', compact('lokasiList', 'videosByLokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lokasiOptions = Data::pluck('lokasi')->unique();
        $kavlingOptions = [];

        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view('dashboard.video.create', compact('lokasiOptions', 'kavlingOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'kavling' => 'required|string',
            'video.*' => 'mimes:mp4,mov,avi,wmv,flv|max:200000', // max 200MB
        ]);

        // cari data_id berdasarkan lokasi + kavling
        $data = Data::where('lokasi', $request->lokasi)
                    ->where('kavling', $request->kavling)
                    ->first();

        if (!$data) {
            return back()->with('error', 'Data kavling tidak ditemukan.');
        }

        // upload video (multiple)
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $file) {
                $path = $file->store('videos', 'public');

                Video::create([
                    'data_id' => $data->id,
                    'video' => $path
                ]);
            }
        }

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('dashboard.video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $lokasiOptions = Data::pluck('lokasi')->unique();

        $kavlingOptions = [];
        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view('dashboard.video.edit', compact('video', 'lokasiOptions', 'kavlingOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
            'kavling' => 'required',
            'video' => 'mimes:mp4,mov,avi,wmv,flv|max:200000'
        ]);

        $video = Video::findOrFail($id);

        // cari data_id baru
        $data = Data::where('lokasi', $request->lokasi)
                    ->where('kavling', $request->kavling)
                    ->first();

        if (!$data) {
            return back()->with('error', 'Data kavling tidak ditemukan.');
        }

        $video->data_id = $data->id;

        // jika ganti file baru
        if ($request->hasFile('video')) {
            if ($video->video && file_exists(storage_path('app/public/' . $video->video))) {
                Storage::delete('public/' . $video->video);
            }

            $path = $request->file('video')->store('videos', 'public');
            $video->video = $path;
        }

        $video->save();

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->video && file_exists(storage_path('app/public/' . $video->video))) {
            Storage::delete('public/' . $video->video);
        }

        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }

    /** 
     * AJAX GET KAVLING
     */
    public function getKavlingsByLocation(Request $request)
    {
        $kavlings = Data::where('lokasi', $request->lokasi)->pluck('kavling');
        return response()->json($kavlings);
    }
}
