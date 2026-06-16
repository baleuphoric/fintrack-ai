<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SavingsGoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/insight', [InsightController::class, 'index'])
    ->name('insight');

Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');

Route::get('/notifications', function () {
    return view('notifications.index');
})->name('notifications');

Route::get('/savings', [SavingsGoalController::class, 'index'])
    ->name('savings');

Route::post(
    '/savings-goals/{id}/deposit',
    [SavingsGoalController::class, 'deposit']
)->name('savings-goals.deposit');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class,'index'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class,'update'])
        ->name('profile.update');

    Route::get('/profile/password', [ProfileController::class,'password'])
        ->name('profile.password');

    Route::post('/profile/password/update', [ProfileController::class,'updatePassword'])
        ->name('profile.password.update');

});

Route::get(
    '/report/pdf',
    [ReportController::class, 'exportPdf']
)->name('report.pdf');

Route::resource('transactions', TransactionController::class);

Route::resource('savings-goals', SavingsGoalController::class);

require __DIR__.'/auth.php';