<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Home');
// })->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/',[PageController::class,'home'])->name('home');

    //question
    Route::get('question/create',[QuestionController::class,'createQuestion'])->name('question.create');
    Route::post('question/create',[QuestionController::class,'storeQuestion'])->name('question.store');
    Route::get('question/like/{id}',[PageController::class,'like'])->name('question.like');
    Route::get('question/disLike/{id}',[PageController::class,'disLike'])->name('question.disLike');
    Route::get('question/detail/{slug}',[PageController::class,'questionDetail'])->name('question.detail');
    Route::post('question/comment',[PageController::class,'createComment'])->name('question.createComment');

    //profile
    Route::get('/profile/edit',[ProfileController::class,'editProfile'])->name('profile.edit');
    Route::get('/profile/userQuestion',[ProfileController::class,'userQuestion'])->name('profile.userQuestion');
});


Route::get('/register',[AuthController::class,'create'])->name('register');
Route::post('/register',[AuthController::class,'store'])->name('postRegister');
Route::get('/login',[AuthController::class,'loginPage'])->name('login');
Route::post('/login',[AuthController::class,'userLogin'])->name('postLogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');