<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test2', function (Request $request) {
    return response()->json([
        'message' => 'API is working!',
        'status' => 'success'
    ], 200);
});