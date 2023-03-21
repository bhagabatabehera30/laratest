<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/blogList', [BlogController::class, 'index'])->name('blog.list');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/save', [BlogController::class, 'store'])->name('blog.store');
    Route::patch('/blog/saveUpdate/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/deleteBlog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
});



require __DIR__.'/auth.php';
