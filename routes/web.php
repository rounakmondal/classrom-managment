<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users;





Route::get('/', function () {
    return view('welcome');
});

Route::get('register',[users::class,'register'])->name('register');

Route::post('regsubmit',[users::class,'regsubmit'])->name('regsubmit');

Route::post('logincheck',[users::class,'logincheck'])->name('logincheck');

Route::get('dashboard',[users::class,'dashboard'])->name('dashboard');
Route::get('sdashboard',[users::class,'sdashboard'])->name('sdashboard');

Route::get('managestudent',[users::class,'managestudent'])->name('managestudent');

Route::post('createclass',[users::class,'createclass'])->name('createclass');

Route::get('deatils/{id}',[users::class,'deatils']);

//this is fpr add a class

Route::post('adclass',[users::class,'addclass']);

//this is for roouting the section

Route::post('/addfile',[users::class,'addfile']);

//this is for donwload a particuler pdf form a section....

Route::post('donwload',[users::class,'download'])->name('download');

//this is route for video upload...

Route::post('/vupload',[users::class,'vupload']);

// this route for download the video section

Route::post('downloadv',[users::class,'downloadv'])->name('downloadv');

//routing for student
// Route::post('sdashboard',[users::class,'sdashboard']);

//this is for student dashboard panels

