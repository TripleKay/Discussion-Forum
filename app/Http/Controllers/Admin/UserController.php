<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    //user list
    public function index(){
    $data = User::with('question','comment')->get();
        return Inertia::render('Admin/User/UserList')->with(['data'=>$data]);
    }

    //edit user
    public function editUser($id){
        $user = User::where('id',$id)->first();
        return Inertia::render('Admin/User/EditUser')->with('user',$user);
    }

    //update user
    public function updateUser($id,Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];
        if($request->hasFile('newImage')){
            $newFile = $request->file('newImage');
            $newFileName = uniqid().'-'.$newFile->getClientOriginalName();

            //get old file
            $oldFileName = User::where('id',$id)->value('image');
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
        User::where('id',$id)->update($updateData);
        return redirect()->route('admin.userList')->with('message','User Updated Successfully');
    }

    //delete user
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return response()->json(
            ['success'=>true]
        );
    }


}