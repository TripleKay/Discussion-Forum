<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function dashboard(){
        return Inertia::render('Admin/Dashboard');
    }

    public function index(){
    $data = User::with('question','comment')->get();
        return Inertia::render('Admin/User/UserList')->with(['data'=>$data]);
    }


}