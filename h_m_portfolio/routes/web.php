<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/portfolio-1', function () {
    return view('portfolio-1');
})->name('portfolio-1');

Route::get('/portfolio-2', function () {
    return view('portfolio-2');
})->name('portfolio-2');

Route::get('/portfolio-3', function () {
    return view('portfolio-3');
})->name('portfolio-3');

Route::get('/portfolio-4', function () {
    return view('portfolio-4');
})->name('portfolio-4');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {

    Route::get('/create-portfolio', [PortfolioController::class, 'show'])->name('portfolio.show');
    
    Route::post('/create-portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return redirect('/');
});

require __DIR__.'/auth.php';