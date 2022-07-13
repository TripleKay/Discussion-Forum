<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(){
        if(Auth::check()){
            return back();
        }
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $file = $request->file('image');
        $newFileName = uniqid().'-'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/users/',$newFileName);

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $newFileName,
        ]);

        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            return redirect()->route('home');
        }
   }

   public function loginPage(){
        if(Auth::check()){
            return back();
        }
        return Inertia::render('Auth/Login');
   }

   public function userLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            return redirect()->route('home');
        }else{
            return back()->with(['message'=>'Your Credential do not match!']);
        }
   }

   public function logout(){
        Auth::logout();
        return redirect()->route('login');
   }

}
