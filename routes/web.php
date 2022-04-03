<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('register',[users::class,'register'])->name('register');

Route::post('regsubmit',[users::class,'regsubmit'])->name('regsubmit');

Route::post('logincheck',[users::class,'logincheck'])->name('logincheck');

Route::get('dashboard',[users::class,'dashboard'])->name('dashboard');
Route::get('managestudent',[users::class,'managestudent'])->name('managestudent');


Route::post('createclass',[users::class,'createclass'])->name('createclass');

Route::get('deatils/{id}',[users::class,'deatils']);

//this is fpr add a class
Route::post('adclass',[users::class,'addclass']);


//this is for roouting the section

Route::post('/addfile',[users::class,'addfile']);