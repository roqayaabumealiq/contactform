<?php

use Illuminate\Support\Facades\Route;
use Roqayapackage\Contactform\Http\Controllers\ContactformController;



Route::middleware(['guest','web'])->group(function(){

Route::get('/contact',[ContactformController::class,'create']);
Route::post('/submit/message',[ContactformController::class,'store']);

});

