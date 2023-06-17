<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Section :-
Route::get('/register',[CustomAuthController::class,'registration']);
Route::post('/register-user',[CustomAuthController::class,'registerUser']);
Route::get('/login',[CustomAuthController::class,'login']);
Route::post('/login-user',[CustomAuthController::class,'loginUser']);
Route::get('/dashboard',[CustomAuthController::class,'dashboard']);
Route::get('/userlist',[CustomAuthController::class,'userlist']);
Route::get('edit/{id}',[CustomAuthController::class,'edit']);
Route::post('update',[CustomAuthController::class,'update']);
Route::get('task/{id}',[CustomAuthController::class,'task']);
Route::post('updatetask',[CustomAuthController::class,'updatetask']);
Route::get('delete/{id}',[CustomAuthController::class,'delete']);
Route::get('/logout',[CustomAuthController::class,'logout']);
Route::get('/password-reset',[CustomAuthController::class,'passwordReset']);
Route::post('/reset-password-submit',[CustomAuthController::class,'passwordResetSubmit']);
Route::get('/password.password.get/{token}',[CustomAuthController::class,'showResetPasswordForm']);
Route::post('/reset.password.post',[CustomAuthController::class,'SubmitPasswordForm']);
Route::get('/change-password',[CustomAuthController::class,'passwordChange'])->middleware('isLoggedIn');
Route::post('/update-password',[CustomAuthController::class,'passwordUpdate'])->middleware('isLoggedIn');

// User Section :-
Route::get('/signup',[MemberController::class,'signup']);
Route::post('/signup-user',[MemberController::class,'signupUser']);
Route::get('/loginUser',[MemberController::class,'loginUser']);
Route::post('/loginMember',[MemberController::class,'loginMember']);
Route::get('/home',[MemberController::class,'home']);