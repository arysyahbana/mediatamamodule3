<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Petugas;
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

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// });
Route::get('/', [FrontHomeController::class, 'index'])->name('home');
Route::get('/category/{category}', [FrontHomeController::class, 'category'])->name('category.articles');
Route::get('/detail/{id}', [FrontHomeController::class, 'detail'])->name('detail');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/show', [UserController::class, 'index'])->name('users.show');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::prefix('author')->group(function () {
        Route::get('/show', [AuthorController::class, 'index'])->name('Author.index');
        Route::post('/store', [AuthorController::class, 'store'])->name('Author.store');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('Author.update');
        Route::get('/destroy/{id}', [AuthorController::class, 'destroy'])->name('Author.destroy');
    });

    Route::prefix('category')->group(function () {
        Route::get('/show', [CategoryController::class, 'index'])->name('Category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('Category.store');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('Category.update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('Category.destroy');
    });

    Route::prefix('tag')->group(function () {
        Route::get('/show', [TagController::class, 'index'])->name('Tag.index');
        Route::post('/store', [TagController::class, 'store'])->name('Tag.store');
        Route::post('/update/{id}', [TagController::class, 'update'])->name('Tag.update');
        Route::get('/destroy/{id}', [TagController::class, 'destroy'])->name('Tag.destroy');
    });

    Route::prefix('article')->group(function () {
        Route::get('/show', [ArticleController::class, 'index'])->name('Article.index');
        Route::post('/store', [ArticleController::class, 'store'])->name('Article.store');
        Route::post('/update/{id}', [ArticleController::class, 'update'])->name('Article.update');
        Route::get('/destroy/{id}', [ArticleController::class, 'destroy'])->name('Article.destroy');
    });
});

require __DIR__ . '/auth.php';
