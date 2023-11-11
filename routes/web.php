<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
})->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get('/registration', function () {
    return view('registration');
})->name('registration');
Route::post('/registration', [AuthController::class, 'registration']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', function () {
        return view('user');
    })->name('user');
});
