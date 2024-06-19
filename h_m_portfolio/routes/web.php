<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTextController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\HtmlController;

Route::get('/', function () {
    $htmlController = new HtmlController();
    $htmlFiles = $htmlController->getHtmlFiles();

    return view('welcome', ['htmlFiles' => $htmlFiles]);
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::post('/delete-portfolio', [PortfolioController::class, 'deletePortfolio'])->name('delete-portfolio');




Route::get('/edit-html/{fileName}', [PortfolioController::class, 'showEditHtml'])->name('edit-html');
Route::post('/update-html/{fileName}', [PortfolioController::class, 'updateHtml'])->name('update-html');




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