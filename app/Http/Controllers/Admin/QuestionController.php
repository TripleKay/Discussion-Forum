<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    //index
    public function questionList(){
        $data = Question::with('user','tag','comment')->get();
        return Inertia::render('Admin/QuestionList')->with(['data'=>$data]);
    }
}