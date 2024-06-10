<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTextController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

<<<<<<< HEAD
=======
//misschien niet eens nodig
// Route::get('/create-html-file', [FileController::class, 'createHtmlFile']);
// Route::get('/dynamic-template', [FileController::class, 'showDynamicTemplate']);

// Route::get('/download-pdf/{fileName}', [PortfolioController::class, 'downloadPDF'])->name('download-pdf'); //dit is het downloaden van de PDF

Route::middleware(['auth'])->group(function () {
    Route::post('/edit-portfolio', [UserTextController::class, 'showForm'])->name('edit-portfolio');
    Route::post('/edit-portfolio', [UserTextController::class, 'index'])->name('edit-portfolio');
    Route::post('/store-text', [UserTextController::class, 'storeText'])->name('store-text');
    Route::get('/generate-html', [UserTextController::class, 'generateHtml'])->name('generate-html');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/portfolio-generator', [PortfolioController::class, 'showGeneratorPage']);
//     Route::get('/generate-portfolio', [PortfolioController::class, 'generatePortfolio']);
//     Route::get('/edit-html/{fileName}', [PortfolioController::class, 'showEditHtml'])->name('edit-html');
//     Route::post('/update-html/{fileName}', [PortfolioController::class, 'updateHtml'])->name('update-html');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
>>>>>>> debcda734c4dfb4f754000f6edbded4635ba9936

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/create-portfolio', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::post('/create-portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/{layout}', [PortfolioController::class, 'showPortfolio'])->name('portfolio.show.layout');


    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return redirect('/');
});

require __DIR__.'/auth.php';