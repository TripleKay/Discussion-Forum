<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    //index
    public function tagList(){
        $data = Tag::get();
        return Inertia::render('Admin/TagList')->with(['data'=>$data]);
    }

}