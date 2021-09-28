<?php

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('tournaments', App\Http\Livewire\Tournaments\Index::class)->name('tournaments.index');
Route::get('tournaments/create', App\Http\Livewire\Tournaments\Edit::class)->name('tournaments.create');
Route::get('tournaments/edit/{tournament}', App\Http\Livewire\Tournaments\Edit::class)->name('tournaments.edit');
Route::get('tournaments/{tournament}', App\Http\Livewire\Tournaments\Show::class)->name('tournaments.show');

require __DIR__.'/auth.php';
