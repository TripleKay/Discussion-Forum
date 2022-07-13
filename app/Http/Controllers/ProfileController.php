<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    //edit profile
    public function editProfile(){
        return Inertia::render('Profile/EditProfile');
    }
}
