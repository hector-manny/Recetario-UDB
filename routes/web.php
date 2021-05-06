<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

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
    return view('auth.login');
});

//Forma estatica
//Route::get('/food/create',[FoodController::class,'create']);
//Forma dinamica
Route::resource('food', FoodController::class)->middleware('auth');
Auth::routes();

Route::get('/home', [FoodController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {


    Route::get('/', [FoodController::class, 'index'])->name('home');
});
