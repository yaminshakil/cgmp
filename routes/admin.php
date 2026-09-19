<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('doctors', DoctorController::class)->except('show');
    Route::resource('posts', PostController::class)->except('show');
    Route::resource('faqs', FaqController::class)->except('show');
    Route::resource('pages', PageController::class)->except('show');

    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('sections', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('sections/hero', [SectionController::class, 'updateHero'])->name('sections.hero');
    Route::put('sections/about', [SectionController::class, 'updateAbout'])->name('sections.about');
    Route::put('sections/nearest-hospitals', [SectionController::class, 'updateNearestHospitals'])->name('sections.nearest-hospitals');
    Route::put('sections/navigation', [SectionController::class, 'updateNavigation'])->name('sections.navigation');
    Route::put('sections/footer-links', [SectionController::class, 'updateFooterLinks'])->name('sections.footer-links');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/test-mail', [SettingController::class, 'testMail'])->name('settings.test-mail');

    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
});
