<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionLike;
use App\Models\QuestionSave;
use Illuminate\Http\Request;
use App\Models\QuestionViewer;
use App\Models\QuestionComment;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCommentNotification;

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

        //notify to user
        $this->notifyToUser($id,'liked your question');

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
    public function questionDetail($slug,$notiId=null){
        $question = Question::where('slug',$slug)->with(['user','comment.user','questionSave','tag'])->first();
        $this->addQuestionViewer($question->id);
        $question->isLike = $this->getLikeDetail($question->id)['isLike'];
        $question->likeCount = $this->getLikeDetail($question->id)['likeCount'];
        $question->isSaved = $this->checkSaveQuestion($question->id);

        //read notification
        if($notiId){
            auth()->user()->notifications->where('id',$notiId)->markAsRead();
        }
        return Inertia::render('Question/QuestionDetail')->with(['question' => $question]);
    }

    //create comment
    public function createComment(Request $request){
        $currentComment = QuestionComment::create([
            'user_id' => Auth::user()->id,
            'question_id' => $request->questionId,
            'comment' => $request->comment,
        ]);

        //notify to user
        $this->notifyToUser($request->questionId,'commented your question');

        $comment = QuestionComment::where('id',$currentComment->id)->with('user')->first();
        return response()->json([
            'success' => true ,
            'comment' => $comment,
        ]);
    }


    private function notifyToUser($questionId,$message){
        //notification
        $data = Question::where('id',$questionId)->first();
        $data->commentUserName = auth()->user()->name;
        $data->commentUserImage = auth()->user()->image;
        $data->message = $message;

        //notify to user
        $user = User::where('id',$data->user_id)->first();
        Notification::send($user, new UserCommentNotification($data));
    }

    //delete comment
    public function deleteComment($id){
        QuestionComment::where('id',$id)->delete();
        return response()->json([
            'success'=> true,
        ]);
    }

    //added question viewer count
    private function addQuestionViewer($questionId){
        QuestionViewer::create([
            'user_id' => auth()->user()->id,
            'question_id' => $questionId,
            'created_at' => Carbon::now(),
        ]);
    }



}