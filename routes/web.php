<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', fn() => redirect()->route('login'));

// Apply guest middleware to auth routes
Route::middleware('guest')->group(function () {
    Auth::routes();
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function (){
    Route::get('/users', [ChatController::class, 'index'])->name('users');
    Route::get('/chat/{receiverId}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/chat/{receiverId}/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/typing', [ChatController::class, 'typing']);
    Route::post('/online', [ChatController::class, 'setOnline']);
    Route::post('/offline', [ChatController::class, 'setOffline']);
    Route::post('/logout', [ChatController::class, 'logout'])->name('logout');
});
