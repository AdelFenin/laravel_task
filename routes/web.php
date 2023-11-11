<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/user', function () {
        return view('user');
    })->name('user');
});

Route::get('/email/verify/success', function () {
    return view('verify_success');
})->name('verify_success');
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'verify'])->name('verification.verify');
Route::get('/not_verified', [EmailController::class, 'notVerified'])->name('verification.notice');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user'], function () {
    Route::group(['prefix' => 'my'], function () {
        Route::patch('/', [UserController::class, 'MyInfoEdit']);
        Route::patch('/password', [UserController::class, 'MyPasswordEdit']);
    });
});
