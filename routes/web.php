<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\TestUserController::class, 'showList'])->name('home');
Route::get('/add',[App\Http\Controllers\TestUserController::class, 'showAddForm'])->name('add');
Route::post('/add',[App\Http\Controllers\TestUserController::class, 'addSubmit'])->name('submit');
Route::post('/delete{id}', [App\Http\Controllers\TestUserController::class, 'delete'])->name('Submit.delete');