<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class CourseController extends Controller
{
    public function index()
    {
        $category = Category::all();
        if(request('search')){
            $course = Course::where('title', 'like' , '%' . request('search') . '%')
                     ->orWhere('deskripsi', 'like' , '%' . request('search') . '%')
                     ->orWhere('category_id', request('search'))
                     ->paginate(9);
            return view('course', compact('course', 'category'));
        }

        $course = Course::paginate(9);
        return view('course', compact('course', 'category'));
    }

    public function show($id){
        return view('courseDetail',[
           "title"=>"course",
           'course' => Course::with('category')->with('materi')->find($id),
           'category' => Category::all()
       ]);
   }
}
