<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function dashboard(){
        return Inertia::render('Admin/Dashboard');
    }

    public function index(){
        $data = User::get();
        return Inertia::render('Admin/UserList')->with(['data'=>$data]);
    }

    
}