<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleContoller; 
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
      // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


   // permission

   Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index' );
   Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
   Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
   Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
   Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
   Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');


   // role

   Route::get('/roles', [RoleContoller::class, 'index'])->name('roles.index');
   Route::get('/roles/create', [RoleContoller::class, 'create'])->name('roles.create');
   Route::get('/roles/{id}/edit', [RoleContoller::class, 'edit'])->name('roles.edit');
   Route::post('/roles', [RoleContoller::class, 'store'])->name('roles.store');
   Route::post('/roles/{id}', [RoleContoller::class, 'update'])->name('roles.update');
   Route::delete('/roles', [RoleContoller::class, 'destroy'])->name('roles.destroy');


    // articles

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles', [ArticleController::class, 'destroy'])->name('articles.destroy');


     // users

     Route::get('/users', [UserController::class, 'index'])->name('users.index');
     Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
     Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
     Route::post('/users', [UserController::class, 'store'])->name('users.store');
     Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
     Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');
     
});

require __DIR__.'/auth.php';
