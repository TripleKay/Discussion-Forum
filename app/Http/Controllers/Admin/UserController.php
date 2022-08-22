<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(){
    $data = User::with('question','comment')->get();
        return Inertia::render('Admin/User/UserList')->with(['data'=>$data]);
    }

    public function deleteUser($id){
        User::where('id',$id)->delete();
        return response()->json(
            ['success'=>true]
        );
    }


}