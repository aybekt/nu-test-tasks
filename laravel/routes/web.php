<?php

use App\Http\Controllers\ApplicationPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApplicationPdfController::class, 'create'])->name('application.form');
Route::post('/pdf', [ApplicationPdfController::class, 'store'])->name('application.pdf');
