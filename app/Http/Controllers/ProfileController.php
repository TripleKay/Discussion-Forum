<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Traits\Question as QuestionTrait;

class ProfileController extends Controller
{
    use QuestionTrait;

    //edit profile
    public function editProfile(){
        return Inertia::render('Profile/EditProfile');
    }

    //update profile
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->hasFile('newImage')){
            $newFile = $request->file('newImage');
            $newFileName = uniqid().'-'.$newFile->getClientOriginalName();

            //get old file
            $oldFileName = User::where('id',auth()->user()->id)->value('image');
            if(!empty($oldFileName)){
                if(File::exists(public_path().'/uploads/users/'.$oldFileName)){
                    File::delete(public_path().'/uploads/users/'.$oldFileName);
                }
                $newFile->move(public_path().'/uploads/users/',$newFileName);
                $updateData['image'] = $newFileName;
            }else{
                $newFile->move(public_path().'/uploads/users/',$newFileName);
                $updateData['image'] = $newFileName;
            }
        }

        User::where('id',Auth::user()->id)->update($updateData);
        return redirect()->back()->with(['message' => 'Your profile updated successfully']);

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
                return redirect()->back()->with(['message' => 'Your password changed successfully']);
            }else{
                return back()->with(['errorMessage' => 'confirm password and new password must be same!']);
            }
        }else{
            return back()->with(['errorMessage' => 'Your Old Password does not match']);
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

    //showAllNotification
    public function showAllNotification(){
        $notifications = auth()->user()->notifications;
        return Inertia::render('Profile/UserNotification')->with(['notifications'=>$notifications]);
    }

    //mask as read notification
    public function markAsRead($id){
        auth()->user()->notifications->where('id',$id)->markAsRead();
        return redirect()->back();
    }
}