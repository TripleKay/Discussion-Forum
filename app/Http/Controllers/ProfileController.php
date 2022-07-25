<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //edit profile
    public function editProfile(){
        return Inertia::render('Profile/EditProfile');
    }

    //user question
    public function userQuestion(){
        $questions = Question::where('user_id',Auth::user()->id)->with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->get();
        return Inertia::render('Profile/UserQuestion')->with(['questions'=>$questions]);
    }
}