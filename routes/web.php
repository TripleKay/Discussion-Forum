<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/',[PageController::class,'home'])->name('home');
});


Route::get('/register',[AuthController::class,'create'])->name('user.create');
Route::post('/register',[AuthController::class,'store'])->name('user.store');
Route::get('/login',[AuthController::class,'loginPage'])->name('user.loginPage');
Route::post('/login',[AuthController::class,'userLogin'])->name('user.userLogin');