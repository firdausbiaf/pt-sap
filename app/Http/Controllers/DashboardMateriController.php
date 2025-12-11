<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DashboardMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(request('course_id')){
            $search=  $materi = DB::table('materis');
            $course_id = request('course_id');
            $search->where('course_id' , 'Like' , '%' . request('course_id') . '%');
            $materi = $search->get();
            return view('dashboard.materi.index',compact('materi','course_id'));
        }

        
            $search=  $materi = DB::table('materis');
            $course_id = session('course_id');
            $search->where('course_id' , 'Like' , '%' . request('course_id') . '%');
            $materi = $search->get();
            return view('dashboard.materi.index',compact('materi','course_id'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = course::all();
        $course_id = new \stdClass();
        $course_id = $request->get('course_id');
        return view('dashboard.materi.create1', [
            'course' => $course,
            'course_id' => $course_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $materi = Materi::all();
        // $course_id = new \stdClass();
        // $course_id = $request->get('course_id');
        // $validatedData = $request->validate([
        //     'subject' => 'required',
        //     'course_id'=>'required',
        //     'link' => 'nullable|url',
        //     'pdf' => 'nullable|mimes:pdf|max:2048'
            
        // ]);

        // if($request->file('pdf')){
        //     $validatedData['pdf'] = $request->file('pdf')->store('course-doc');
        // }

        // Materi::create($validatedData, ['course_id' => $validatedData['course_id']]); 
        // return redirect('/admin/materi')->with('course_id' , $course_id)->with('success', 'Pertemuan baru telah ditambahkan');
        $course_id = new \stdClass();
        $course_id = $request->get('course_id');
        foreach($request->subject as $key=>$subject){
            $data = new Materi();
            $data->subject = $subject;
            $data->course_id =$course_id;
            
             if($request->file('pdf')){
             $data->pdf = $request->file('pdf')[$key]->store('course-doc');
            }

            $data->save();
        }

        return redirect('/admin/materi')->with('course_id' , $course_id)->with('success', 'Pertemuan telah ditambahkan');
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
    public function edit(Request $request, $id)
    {
        $materi = Materi::with('course')->where('id', $id)->first();
        $course_id = new \stdClass();
        $course_id = $request->get('course_id');
        return view('dashboard.materi.edit', compact('materi', 'course_id'));
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
        
        $materi = Materi::all();
        $course_id = new \stdClass();
        $course_id = $request->get('course_id');
        $request->validate([
            'subject' => 'required',
            'course_id'=>'required',
            'link' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:2048'
        ]);

        $materi = Materi::where('id', $id)->first();
        $materi->subject = $request->get('subject');
        $materi->link = $request->get('link');

        if($request->file('pdf')){
            if($request->oldpdf){
                Storage::delete($request->oldpdf);
            }
            $materi->pdf = $request->file('pdf')->store('course-doc');
        }

        $materi->save();

        return redirect('/admin/materi')->with('course_id' , $course_id)->with('success', 'Pertemuan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        
        $course_id = new \stdClass();
        $course_id = $request->get('course_id');
        $materi = Materi::where('id', $id)->first();
        if($materi->pdf){
            Storage::delete($materi->pdf);
        }
        $materi->delete();
        return redirect('/admin/materi')->with('course_id' , $course_id)->with('success', 'Pertemuan telah dihapus');
    }


}
