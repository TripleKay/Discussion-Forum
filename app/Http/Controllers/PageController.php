<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    //index
    public function home(){
        $questions = Question::with(['user','comment','questionSave','tag'])->get();
        foreach($questions as $key => $question){
            $question->isLike = $this->likeDetial($question->id)['isLike'];
            $question->likeCount = $this->likeDetial($question->id)['likeCount'];
        }
        return Inertia::render('Home')->with(['questions' => $questions]);
    }

    //like detail
    private function likeDetial($questionId){
        //check is_like
        $like = QuestionLike::where('question_id',$questionId)->where('user_id',Auth::user()->id)->first();
        if($like){
            $isLike = true;
        }else{
            $isLike = false;
        }

        //like count
        $likeCount = QuestionLike::where('question_id',$questionId)->count();
        $data = [
            'isLike' => $isLike,
            'likeCount' => $likeCount
        ];

        return $data;
    }
}