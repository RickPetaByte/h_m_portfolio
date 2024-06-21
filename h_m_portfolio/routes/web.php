<?php

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

Route::get('/create-html-file', [FileController::class, 'createHtmlFile']);
Route::get('/dynamic-template', [FileController::class, 'showDynamicTemplate']);

Route::post('/delete-portfolio', [PortfolioController::class, 'deletePortfolio'])->name('delete-portfolio');
Route::post('/update-html/{fileName}', [UserTextController::class, 'updateHtml'])->name('update-html');
Route::get('refresh-csrf', function(){
    return csrf_token();
});

Route::middleware('auth')->group(function () {
    Route::get('/create-portfolio', [UserTextController::class, 'showForm'])->name('create-portfolio');
    Route::post('/store-text', [UserTextController::class, 'storeText'])->name('store-text');
    Route::get('/generate-html', [UserTextController::class, 'generateHtml'])->name('generate-html');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', function () {
    return redirect('/');
});

require __DIR__.'/auth.php';