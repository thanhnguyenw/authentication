<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::get('/',[WebsiteController::class,'index'])->name('home');
// dashboard user, /dashboard-user
Route::get('/dashboard-user',[WebsiteController::class,'dashboard_user'])->name('dashboard_user')->middleware('auth');


// login
Route::get('/login',[WebsiteController::class,'login'])->name('login');
Route::post('/login_submit',[WebsiteController::class,'login_submit'])->name('login_submit');

//logout
Route::get('/logout',[WebsiteController::class,'logout'])->name('logout');

// registration
Route::get('/registration',[WebsiteController::class,'registration'])->name('registration');
Route::post('/registration_submit',[WebsiteController::class,'registration_submit'])->name('registration_submit');

Route::get('/registration/verify/{token}/{email}',[WebsiteController::class,'registration_verify']);
// forget_password
Route::get('/forget-password',[WebsiteController::class,'forget_password'])->name('forget_password');
Route::post('/forget_password_submit',[WebsiteController::class,'forget_password_submit'])->name('forget_password_submit');
// reset_password
Route::get('/reset-password/{token}/{email}',[WebsiteController::class,'reset_password'])->name('reset_password');
Route::post('/reset_password_submit',[WebsiteController::class,'reset_password_submit'])->name('reset_password_submit');

/* Admin */
Route::get('/admin/login',[AdminController::class,'login'])->name('admin_login');
Route::post('/admin/login-submit',[AdminController::class,'login_submit'])->name('admin_login_submit');

// dashboard admin
Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin_dashboard') ->middleware('admin:admin');
Route::get('/admin/settings',[AdminController::class,'settings'])->name('admin_settings')->middleware('admin:admin');
// admin_logout
Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin_logout');