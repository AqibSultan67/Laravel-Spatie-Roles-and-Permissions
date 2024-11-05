<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('test-data', function () {
//  dd('Aqib' . '-' . '23');
// $name = "Aqib Sultan";
// $a = explode(' ', $name);
// $a[1] = strrev($a[1]);
// $reverse = implode(' ', $a);
// echo $reverse;
return view('users.test');
 });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/permissions', [PermissionController::class, 'show'])->name('permissions.index');
Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


Route::get('/roles', [RoleController::class, 'show'])->name('roles.index');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::resource('articles', ArticleController::class);

Route::resource('users', UserController::class);



});


require __DIR__.'/auth.php';
