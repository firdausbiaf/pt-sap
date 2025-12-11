<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transaksi = transaksi::with('category')->get();
        $transaksi = transaksi::paginate(6);
        return view('dashboard.transaksi.index', compact('transaksi'))->with('i', (request()
            ->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'course_id'=>'required',
            'bukti' => 'nullable|image|file|max:2048' 
        ]);
        $transaksi = new Transaksi();
        $transaksi->course_id = $request->get('course_id');
        $transaksi->user_id = $request->user()->id;

        if ($request->file('bukti')) {
            $transaksi->bukti = $request->file('bukti')->store('transaksi-img');
        }

        $transaksi->save();

        return redirect('/course')->with('success', 'Terima Kasih telah melakukan pembayaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        if($transaksi->photo){
            Storage::delete($transaksi->bukti);
        }
        $transaksi->delete();
        return redirect('/transaksi')->with('success', 'Transaksi telah dihapus');
    }

    public function bayar(Request $request){
        $request->validate([
            'bukti' => 'image|file|max:2048'
        ]);

        // $transaksi = Transaksi::where('id', $request->id)->first();
        $transaksi = Transaksi::where('id', $request->id)->first();
        if($request->file('bukti')){
            $transaksi->bukti = $request->file('bukti')->store('transaksi-img');
        }

        $transaksi->save();

        return redirect('/transaksiMember')->with('success', 'Terima Kasih telah melakukan transaksi');

    }

    public function verify(Request $request){
      
        $transaksi = Transaksi::where('id', $request->id)->first();
            $transaksi->verify = '1';
            $transaksi->save();

        return redirect('/transaksi');
    }
}
