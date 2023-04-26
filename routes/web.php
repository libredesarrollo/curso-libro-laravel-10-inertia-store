<?php

use App\Http\Controllers\Contact\GeneralController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/category', App\Http\Controllers\Dashboard\CategoryController::class);
    Route::resource('/post', App\Http\Controllers\Dashboard\PostController::class);

    Route::post('/post/upload/{post}', [App\Http\Controllers\Dashboard\PostController::class, 'upload'])->name('post.upload');

    Route::delete('post/image/delete/{post}', [App\Http\Controllers\Dashboard\PostController::class, 'imageDelete'])->name('post.image-delete');
});

Route::group([
    'prefix' => 'contact',
    'middleware' => 'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
], function () {
    Route::resource('contact-general', GeneralController::class)->only(['create', 'edit', 'store', 'update']);
    Route::resource('contact-company', App\Http\Controllers\Contact\CompanyController::class)->only(['create', 'edit', 'store', 'update']);
    Route::resource('contact-person', App\Http\Controllers\Contact\PersonController::class)->only(['create', 'edit', 'store', 'update']);
    Route::resource('contact-detail', App\Http\Controllers\Contact\DetailController::class)->only(['create', 'edit', 'store', 'update']);
});

Route::group([
    'prefix' => 'blog',
], function () {
    Route::get('/', [App\Http\Controllers\Blog\PostController::class, 'index'])->name("web.index");
    Route::get('/{post:slug}', [App\Http\Controllers\Blog\PostController::class, 'show'])->name("web.show");
});

Route::group([
    'prefix' => 'shop',
], function () {
    Route::get('/', [App\Http\Controllers\Shop\CartController::class, 'index'])->name('shop.index');
    Route::post('/add/{post}/{count}', [App\Http\Controllers\Shop\CartController::class, 'add'])->name('shop.add');
});

Route::group([
    'prefix' => 'todo',
], function () {
    Route::get('/', [App\Http\Controllers\TodoController::class, 'index'])->name('todo.index');
    Route::post('store', [App\Http\Controllers\TodoController::class, 'store'])->name('todo.store');
    Route::put('update/{todo}', [App\Http\Controllers\TodoController::class, 'update'])->name('todo.update');
    Route::delete('destroy/{todo?}', [App\Http\Controllers\TodoController::class, 'destroy'])->name('todo.destroy');
    Route::post('status/{todo}', [App\Http\Controllers\TodoController::class, 'status'])->name('todo.status');
    Route::post('orden', [App\Http\Controllers\TodoController::class, 'orden'])->name('todo.orden');
});