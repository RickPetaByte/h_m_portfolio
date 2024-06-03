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

Route::middleware('auth')->group(function () {
    Route::get('/create-portfolio', function () {
        return view('create-portfolio');
    })->name('create');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return redirect('/');
});

require __DIR__.'/auth.php';