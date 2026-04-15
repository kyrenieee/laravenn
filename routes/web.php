<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splash');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tables', [TablesController::class, 'index'])->name('tables');

    Route::resource('users', UserController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('halls', HallController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('showtimes', ShowtimeController::class);
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Movies Management
    Route::get('/movies', [AdminDashboardController::class, 'movies'])->name('movies');
    Route::get('/movies/create', [AdminDashboardController::class, 'createMovie'])->name('movies.create');
    Route::post('/movies', [AdminDashboardController::class, 'storeMovie'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [AdminDashboardController::class, 'editMovie'])->name('movies.edit');
    Route::put('/movies/{movie}', [AdminDashboardController::class, 'updateMovie'])->name('movies.update');
    Route::delete('/movies/{movie}', [AdminDashboardController::class, 'deleteMovie'])->name('movies.delete');

    // Halls Management
    Route::get('/halls', [AdminDashboardController::class, 'halls'])->name('halls');
    Route::get('/halls/create', [AdminDashboardController::class, 'createHall'])->name('halls.create');
    Route::post('/halls', [AdminDashboardController::class, 'storeHall'])->name('halls.store');
    Route::get('/halls/{hall}/edit', [AdminDashboardController::class, 'editHall'])->name('halls.edit');
    Route::put('/halls/{hall}', [AdminDashboardController::class, 'updateHall'])->name('halls.update');
    Route::delete('/halls/{hall}', [AdminDashboardController::class, 'deleteHall'])->name('halls.delete');
});

require __DIR__.'/auth.php';
