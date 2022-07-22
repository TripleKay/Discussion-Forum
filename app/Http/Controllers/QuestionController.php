<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    //create question
    public function createQuestion(){
        return Inertia::render('Question/QuestionCreate');
    }
}