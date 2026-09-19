<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\BookingController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\DoctorController;
use App\Http\Controllers\Public\EmergencyController;
use App\Http\Controllers\Public\FaqController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->whereNumber('doctor')->name('doctors.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/book-appointment', BookingController::class)->name('booking');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/faq', FaqController::class)->name('faq');
Route::get('/emergency', EmergencyController::class)->name('emergency');
Route::get('/privacy-policy', [PageController::class, 'show'])->defaults('page', 'privacy-policy')->name('pages.privacy');
Route::get('/terms', [PageController::class, 'show'])->defaults('page', 'terms')->name('pages.terms');
Route::get('/fees-info', [PageController::class, 'show'])->defaults('page', 'fees-info')->name('pages.fees-info');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
