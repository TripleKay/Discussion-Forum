<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\Question as QuestionTrait;

class ProfileController extends Controller
{
    use QuestionTrait;

    //edit profile
    public function editProfile(){
        return Inertia::render('Profile/EditProfile');
    }

    //edit password
    public function editPassword(){
        return Inertia::render('Profile/EditPassword');
    }

    //update password
    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        $userData = User::where('id',auth()->user()->id)->first();
        $oldHashPassword = $userData->password;

        if(Hash::check($oldPassword,$oldHashPassword)){
            if($newPassword == $confirmPassword){
                User::where('id',auth()->user()->id)->update([
                    'password' => Hash::make($newPassword),
                ]);
                return back()->with(['success' => 'Your password changed successfully']);
            }else{
                return back()->with(['message' => 'confirm password and new password must be same!']);
            }
        }else{
            return back()->with(['message' => 'Your Old Password does not match']);
        }
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

    //save question page
    public function showSaveQuestion(){
        $questions = QuestionSave::select('question_id')->where('user_id',Auth::user()->id)->with('question')->paginate(3);
        return Inertia::render('Question/SavedQuestions')->with(['questions' => $questions]);
    }
}