<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index' ,[
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        $ValidatedData = $request -> validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);


        $ValidatedData['password'] = bcrypt($ValidatedData['password']);

        User::create($ValidatedData);
        // $request->session()->flash('success','Registrasi berhasil, silahkan Login');
        return redirect('/')->with('success','Registrasi berhasil');
    }
}
