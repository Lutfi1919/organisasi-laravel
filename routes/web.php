<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CouncilController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function() {
    Route::get('/laporGDS', [ReportController::class, 'create'])->name('laporGDS');
    Route::post('/store', [ReportController::class, 'store'])->name('store');
});

Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/users')->name('users.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [StaffController::class, 'destroy'])->name('delete');
        Route::get('/export', [StaffController::class, 'export'])->name('export');
        Route::get('/trash', [StaffController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [StaffController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [StaffController::class, 'deletePermanent'])->name('delete_permanent');
    });
    Route::prefix('/reports')->name('reports.')->group(function() {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/chart', [DashboardController::class, 'chartData'])->name('chart');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ReportController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ReportController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ReportController::class, 'destroy'])->name('delete');
        Route::get('/export', [ReportController::class, 'export'])->name('export');
        Route::get('/trash', [ReportController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [ReportController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [ReportController::class, 'deletePermanent'])->name('delete_permanent');
        Route::get('/{id}/export/pdf', [ReportController::class, 'exportPdf'])->name('export.pdf');
    });
    Route::prefix('/events')->name('events.')->group(function() {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('delete');
        Route::get('/export', [EventController::class, 'export'])->name('export');
        Route::get('/trash', [EventController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [EventController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [EventController::class, 'deletePermanent'])->name('delete_permanent');
    });
    Route::prefix('/gallery')->name('gallery.')->group(function() {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/store', [GalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('delete');
        Route::get('/export', [GalleryController::class, 'export'])->name('export');
        Route::get('/trash', [GalleryController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [GalleryController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [GalleryController::class, 'deletePermanent'])->name('delete_permanent');
    });
    Route::prefix('/osis')->name('osis.')->group(function() {
        Route::get('/', [CouncilController::class, 'index'])->name('index');
        Route::get('/create', [CouncilController::class, 'create'])->name('create');
        Route::post('/store', [CouncilController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CouncilController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CouncilController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CouncilController::class, 'destroy'])->name('delete');
        Route::get('/export', [CouncilController::class, 'export'])->name('export');
        Route::get('/trash', [CouncilController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [CouncilController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [CouncilController::class, 'deletePermanent'])->name('delete_permanent');
    });
});
