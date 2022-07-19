<?php

namespace App\Traits;

use App\Models\QuestionLike;
use Illuminate\Support\Facades\Auth;

trait Question {
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
}