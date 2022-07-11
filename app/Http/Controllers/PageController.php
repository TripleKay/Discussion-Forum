<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    //index
    public function home(){
        return Inertia::render('Home');
    }
}