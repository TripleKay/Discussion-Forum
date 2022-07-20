<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionComment;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Traits\Question as QuestionTrait;
class PageController extends Controller
{
    use QuestionTrait;
    //index
    public function home(){
        $questions = Question::with(['user','comment','questionSave','tag'])->get();
        foreach($questions as $key => $question){
            $question->isLike = $this->getLikeDetail($question->id)['isLike'];
            $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
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
        $question = Question::where('slug',$slug)->with(['user','comment.user','questionSave','tag'])->first();
        $question->isLike = $this->getLikeDetail($question->id)['isLike'];
        $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
        return Inertia::render('Question/QuestionDetail')->with(['question' => $question]);
    }

    //create comment
    public function createComment(Request $request){
        $currentComment = QuestionComment::create([
            'user_id' => Auth::user()->id,
            'question_id' => $request->questionId,
            'comment' => $request->comment,
        ]);

        $comment = QuestionComment::where('id',$currentComment->id)->with('user')->first();
        return response()->json([
            'success' => true ,
            'comment' => $comment,
        ]);
    }

}