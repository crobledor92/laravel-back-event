<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    (new SessionController())->shareData();
    return view('landing');
})->name('landing');

Route::get('/register', function () {
    (new SessionController())->shareData();
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', function () {
    (new SessionController())->shareData();
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/logout', function () {
    (new SessionController())->shareData();
    return view('login', ['logout' => true]);
})->name('logout');

Route::get('/personal-panel', function () {
    (new SessionController())->shareData();
    return view('personal-panel');
})->name('personal-panel');

Route::get('/edit-profile', function () {
    (new SessionController())->shareData();
    return view('edit-profile');
})->name('edit-profile');

Route::get('/admin-panel', function () {
    (new SessionController())->shareData();
    return view('admin-panel');
})->name('admin-panel');