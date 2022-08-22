<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Question as QuestionTrait;

class QuestionController extends Controller
{
    use QuestionTrait;

    //index
    public function questionList(){
        $data = Question::with('user','tag','comment')->get();
        return Inertia::render('Admin/Question/QuestionList')->with(['data'=>$data]);
    }

    //show question
    public function showQuestion($slug){
        $question = Question::where('slug',$slug)->with(['user','comment.user','questionSave','tag'])->first();
        $question->isLike = $this->getLikeDetail($question->id)['isLike'];
        $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
        $question->isSaved = $this->checkSaveQuestion($question->id);
        return Inertia::render('Admin/Question/ShowQuestion')->with(['question' => $question]);
    }

    //delete question
    public function deleteQuestion($id){
        Question::where('id',$id)->delete();
        return response()->json([
            'success'=>true
        ]);
    }
}