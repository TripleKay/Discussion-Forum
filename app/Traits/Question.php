<?php

namespace App\Traits;

use App\Models\QuestionLike;
use App\Models\QuestionSave;
use Illuminate\Support\Facades\Auth;

trait Question {
    //get like detail
    public function getLikeDetail($questionId){
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

    //save question check on user
    public function checkSaveQuestion($questionId){
        $saveQuestion = QuestionSave::where('question_id',$questionId)->where('user_id',auth()->user()->id)->first();
        if($saveQuestion){
            $isSaved = true;
        }else{
            $isSaved = false;
        }
        return $isSaved;
    }
}