<?php

use App\Http\Controllers\Userpanel\HomeController;
use App\Http\Controllers\Userpanel\BookingController;
use App\Http\Controllers\Auth\FrontendAuthController;
use App\Http\Controllers\Userpanel\CareerController;
use Illuminate\Support\Facades\Route;

Route::get('adminpanel', function () {
    return view('auth.login');
});

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('booking', [HomeController::class, 'bookingSearch'])->name('booking');

// Frontend Authentication Routes

// Public routes (accessible without authentication)
Route::get('/login', [FrontendAuthController::class, 'showLoginForm'])->name('login');
Route::post('/passenger-login', [FrontendAuthController::class, 'login'])->name('passenger-login');
Route::get('/register', [FrontendAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/passenger-register', [FrontendAuthController::class, 'register'])->name('passenger-register');
Route::get('/email-verification/{id}', [FrontendAuthController::class, 'showVerification'])->name('email-verification');
Route::post('/verfy-email', [FrontendAuthController::class, 'emailVerification'])->name('verfy-email');
Route::post('/resend-verification-code', [FrontendAuthController::class, 'resendVerificationCode'])->name('resend-verification-code');
Route::get('/reset-password', [FrontendAuthController::class, 'showResetPassword'])->name('reset-password');
Route::post('/send-reset-link', [FrontendAuthController::class, 'sendResetLink'])->name('send-reset-link');
Route::get('/set-new-password/{token}', [FrontendAuthController::class, 'showSetNewPassword'])->name('set-new-password');
Route::post('/save-new-password', [FrontendAuthController::class, 'saveNewPassword'])->name('save-new-password');

Route::post('/booking-details', [HomeController::class, 'bookingDetails'])->name('booking-details');
Route::post('/payment', [HomeController::class, 'payment'])->name('payment');
Route::post('/booking-email-verfy', [HomeController::class, 'bookingEmailVerfy'])->name('booking-email-verfy');
Route::get('/payment', [HomeController::class, 'showPayment'])->name('go-payment');
Route::get('/check-email', [HomeController::class, 'checkEmail'])->name('check-email');

Route::post('/confirm-payment', [HomeController::class, 'confirmPayment'])->name('confirm-payment');

Route::get('/career', [CareerController::class, 'index'])->name('career');
Route::get('/job-detail-driver', [CareerController::class, 'driver'])->name('job-detail-driver');
Route::post('/save-driver', [CareerController::class, 'saveDriver'])->name('save-driver');
Route::get('/job-detail-instructor', [CareerController::class, 'instructor'])->name('job-detail-instructor');
Route::post('/save-instructor', [CareerController::class, 'saveInstructor'])->name('save-instructor');
Route::get('/job-detail-mechanic', [CareerController::class, 'mechanic'])->name('job-detail-mechanic');
Route::post('/save-mechanic', [CareerController::class, 'saveMechanic'])->name('save-mechanic');






// Protected routes (require frontend authentication)
 Route::group(['middleware' => ['auth:frontend', 'frontend']], function () {
    Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
   
    Route::get('dashboard', [FrontendAuthController::class, 'dashboard'])->name('passenger-dashboard');

    Route::get('my-profile', [FrontendAuthController::class, 'profile'])->name('my-profile');
    Route::post('/update-profile', [FrontendAuthController::class, 'updateProfile'])->name('update-user-profile');
});



require __DIR__ . '/auth.php';
