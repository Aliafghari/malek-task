<?php

use App\Http\Controllers\Auth\resetPasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




// Route::get('/reset-password', [resetPasswordController::class, 'showResetForm'])
//     ->middleware('guest')
//     ->name('password.request');

// // Route to handle the verification code submission
// Route::post('/reset-password/verify', [resetPasswordController::class, 'verifyCode'])
//     ->middleware('guest')
//     ->name('password.verify');

// // Route to display the form for entering the new password after verification
// Route::get('/reset-password/{reset_num}/{token}', [resetPasswordController::class, 'showResetWithCodeForm'])
//     ->middleware('guest')
//     ->name('password.reset');
    
});

require __DIR__.'/auth.php';