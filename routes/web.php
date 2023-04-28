<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('books', BookController::class)->parameters([
    'books' => 'book:slug'
])->withTrashed(['index', 'show', 'destroy']);

Route::post('/books/{book:slug}/restore', [BookController::class, 'restore'])->name('books.restore')->withTrashed();
