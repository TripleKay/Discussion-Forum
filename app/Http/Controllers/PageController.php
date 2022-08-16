<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use App\Models\QuestionComment;
use App\Models\QuestionSave;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;

class PageController extends Controller
{
    use QuestionTrait;
    //index
    public function home(Request $request){
        if($request->tag){
            $slug = $request->tag;
            $tag = Tag::where('slug',$slug)->first();
            $questions = $tag->question()->with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->paginate(3);
        }elseif($request->type){
            if($request->type == 'answered'){
                $questions = Question::whereHas('comment',function($query){
                    $query->where('user_id',Auth::user()->id);
                })->with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->paginate(3);
            }elseif($request->type == 'unanswered'){
                $questions = Question::has('comment','<','1')->with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->paginate(3);
            }
        }else{
            $questions = Question::with(['user','comment','questionSave','tag'])->orderBy('id','DESC')->paginate(3);
        }
        // return $questions;
        foreach($questions as $key => $question){
            $question->isLike = $this->getLikeDetail($question->id)['isLike'];
            $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
            $question->isSaved = $this->checkSaveQuestion($question->id);
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
            'success' => true,
        ]);
    }

    //dislike
    public function disLike($id){
        QuestionLike::where('question_id',$id)->where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //question detail
    public function questionDetail($slug){
        $question = Question::where('slug',$slug)->with(['user','comment.user','questionSave','tag'])->first();
        $question->isLike = $this->getLikeDetail($question->id)['isLike'];
        $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
        $question->isSaved = $this->checkSaveQuestion($question->id);
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

    //save question check on user
    private function checkSaveQuestion($questionId){
        $saveQuestion = QuestionSave::where('question_id',$questionId)->where('user_id',auth()->user()->id)->first();
        if($saveQuestion){
            $isSaved = true;
        }else{
            $isSaved = false;
        }
        return $isSaved;
    }

}