<?php
use App\Http\Controllers\ContactFormController;

Route::post('/contact', [ContactFormController::class, 'store']);
Route::get('/', function (Request $request) {
    return response()->json([
        'message' => 'API is working!',
        'status' => 'success'
    ], 200);
});
