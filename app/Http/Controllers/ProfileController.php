<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;

class ProfileController extends Controller
{
    use QuestionTrait;

    //edit profile
    public function editProfile(){
        return Inertia::render('Profile/EditProfile');
    }

    //user question
    public function userQuestion(){
        $questions = Question::where('user_id',Auth::user()->id)->with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->paginate(5);
        foreach($questions as $key => $question){
            $question->isLike = $this->getLikeDetail($question->id)['isLike'];
            $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
        }
        return Inertia::render('Profile/UserQuestion')->with(['questions'=>$questions]);
    }
}
