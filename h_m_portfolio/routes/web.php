<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTextController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\HtmlController;
use App\Http\Controllers\ImageUploadController;

// Route for the dashboard page
Route::get('/', function () {
    // Instantiate HtmlController to retrieve HTML files
    $htmlController = new HtmlController();
    $htmlFiles = $htmlController->getHtmlFiles();

    // Pass HTML files to the welcome view
    return view('welcome', ['htmlFiles' => $htmlFiles]);
})->name('dashboard'); // Named route for dashboard

// Route for the about page
Route::get('/about', function () {
    return view('about');
})->name('about'); // Named route for about

// Routes for the contact page
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show'); // Show contact form
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send'); // Process contact form submission

// For uploading image if you select in the edit page 
Route::post('/upload-image', [ImageUploadController::class, 'uploadImage'])->name('upload.image');

// Route to handle portfolio deletion
Route::post('/delete-portfolio', [PortfolioController::class, 'deletePortfolio'])->name('delete-portfolio');

// Routes for editing and updating HTML portfolios
Route::get('/edit-html/{fileName}', [PortfolioController::class, 'showEditHtml'])->name('edit-html'); // Show HTML edit form
Route::post('/update-html/{fileName}', [PortfolioController::class, 'updateHtml'])->name('update-html'); // Update HTML portfolio

// Routes that require authentication
Route::middleware('auth')->group(function () {
    // Route to show form for creating a portfolio
    Route::get('/create-portfolio', [UserTextController::class, 'showForm'])->name('create-portfolio');
    
    // Route to store portfolio text
    Route::post('/store-text', [UserTextController::class, 'storeText'])->name('store-text');
    
    // Route to generate HTML from portfolio data
    Route::get('/generate-html', [UserTextController::class, 'generateHtml'])->name('generate-html');
    
    // Routes for profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Show profile edit form
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete profile
});

// Redirect /dashboard route to /
Route::get('/dashboard', function () {
    return redirect('/');
});

// Include Laravel's default authentication routes
require __DIR__.'/auth.php';