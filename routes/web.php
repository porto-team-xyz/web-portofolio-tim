<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;

Route::get('/', function () {
    return view('test');
});
Route::get('/home', function(){ return view('welcome'); });

Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
