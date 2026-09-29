<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\HomeController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class, 'index']);
