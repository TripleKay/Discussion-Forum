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

    //like
    public function like($id){
        QuestionLike::create([
            'user_id' => Auth::user()->id,
            'question_id' => $id,
        ]);
        return response()->json([
            'success' => 'like success',
        ]);
    }

    //dislike
    public function disLike($id){
        QuestionLike::where('question_id',$id)->where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'success' => 'dislike success',
        ]);
    }

    //question detail
    public function questionDetail($slug){
        return Inertia::render('Question/QuestionDetail');
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