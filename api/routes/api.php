<?php
use App\Http\Controllers\ContactFormController;

Route::post('/contact', [ContactFormController::class, 'store']);
