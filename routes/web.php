<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::resource('todos', TodoController::class);
Route::post('todos/{todo}/toggle', [TodoController::class, 'toggleComplete'])->name('todos.toggle');

Route::get('/', function () {
    return view('welcome');
});
