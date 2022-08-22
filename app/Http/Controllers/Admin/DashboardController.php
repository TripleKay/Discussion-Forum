<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //index
    public function dashboard(){
        $questions = Question::with('user','comment')->orderBy('id','DESC')->get();
        $users = User::select(DB::raw('COUNT(id) as user_count'))->value('user_count');
        $tags = Tag::select(DB::raw('COUNT(id) as tag_count'))->value('tag_count');
        return Inertia::render('Admin/Dashboard')->with(['questions'=>$questions,'users'=>$users,'tags'=>$tags]);
    }

}