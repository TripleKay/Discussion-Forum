<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionSave;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //search question
    public function searchQuestion(Request $request){
        $questions = Question::select('id','title','slug')->where('title','like','%'.$request->searchKey.'%')->get();
        return response()->json([
            'questions' => $questions,
        ]);
    }

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

        return redirect()->route('home')->with(['message'=>'Question created successfully']);
    }

    //redirect edit question page
    public function editQuestion($slug){
        $question = Question::where('slug',$slug)->with(['tag'])->first();
        return Inertia::render('Question/QuestionEdit')->with(['question' => $question]);
    }

    //update question page
    public function updateQuestion($slug,Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ]);

        $title = $request->title;
        $description = $request->description;
        $tagsArr = explode(',',$request->tags);

        $question = Question::where('slug',$slug)->first();
        //to delete que_tag relations
        $question->tag()->detach();

        $updateData = [
            'title' => $title,
            'description' => $description,
        ];

        // slug depends on title changes
        if($title != $question->title){
            $updateData['slug'] = Str::slug($title).'-'.uniqid();
        }

        $question->update($updateData);

        //to add que_tag relations
        $question->tag()->attach($tagsArr);

        return redirect()->route('home')->with(['message'=>'Question updated successfully']);
    }

    //delete Question
    public function deleteQuestion($id){
        Question::where('id',$id)->delete();
        return response()->json([
            'success'=> true,
        ]);
    }

    //make solved
    public function makeSolved(Request $request){
        Question::where('id',$request->id)->update([
            'is_solved' => 'true'
        ]);
        return response()->json([
            'success'=> true,
        ]);
    }

    //save question
    public function saveQuestion(Request $request){
        QuestionSave::create([
            'user_id' => Auth()->user()->id,
            'question_id' => $request->id
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    //unSave question
    public function unSaveQuestion(Request $request){
        QuestionSave::where('user_id',Auth()->user()->id)->where('question_id',$request->id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

}