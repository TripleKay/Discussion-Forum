<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //create question
    public function createQuestion(){
        return Inertia::render('Question/QuestionCreate');
    }

    //store question
    public function storeQuestion(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ]);

        $title = $request->title;
        $description = $request->description;
        $tagsArr = explode(',',$request->tags);

        $Questiondata = [
            'user_id' => Auth::user()->id,
            'title' => $title,
            'description' => $description,
            'slug' => Str::slug($title).'-'.uniqid(),
            'created_at' => Carbon::now(),
        ];
        $createdQuestion = Question::create($Questiondata);

        $currentQuestion = Question::find($createdQuestion->id);
        $currentQuestion->tag()->attach($tagsArr);

        return redirect()->route('home');
    }

    //delete Question
    public function deleteQuestion($id){
        Question::where('id',$id)->delete();
        return response()->json([
            'success'=> true,
        ]);
    }
}