<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryItemsController;
use App\Http\Controllers\BorrowingLibraryItemController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/login', function (Request $request) {
//    $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate(); // Standard session regen
//         return response()->json(['message' => 'Logged in']);
//     }

//     return response()->json(['error' => 'Unauthorized'], 401);
// });
// Route::middleware('auth:sanctum')->group(function () {
//     Route::controller(LibraryItemsController::class)->prefix('library-items')->group(function () {
//         Route::get('index', 'index')->name('index');
//         Route::get('edit/{id}', 'edit')->name('edit');
//         Route::post('store', 'store')->name('store');
//         Route::post('update', 'update')->name('update');
//         Route::get('delete/{id}', 'delete/{id}')->name('delete');
//     });
//     Route::controller(BorrowingLibraryItemController::class)->prefix('borrow')->group(function () {
//         Route::get('edit/{id}', 'edit')->name('edit');
//         Route::post('store', 'store')->name('store');
//         Route::post('update', 'update')->name('update');
//     });
// });
