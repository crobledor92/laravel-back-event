<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/logout', function () {
    return view('login', ['logout' => true]);
})->name('logout');

Route::get('/personal-panel', function () {
    return view('personal-panel');
})->name('personal-panel');

Route::get('/edit-profile', function () {
    return view('edit-profile');
})->name('edit-profile');

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->name('admin-panel');