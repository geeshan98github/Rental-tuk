<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\MetaTagsController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\DriverApplicantController;
use App\Http\Controllers\Admin\MechanicApplicantController;
use App\Http\Controllers\Admin\InstructorApplicantController;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('cms-login', [AuthenticatedSessionController::class, 'create'])->name('cms-login');

    Route::post('cms-login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::group(['middleware' => ['auth:web', 'check_permission']], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('cms-logout', [AuthenticatedSessionController::class, 'destroy'])->name('cms-logout');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::prefix('adminpanel')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('log-activity-list', [LogActivityController::class, 'list'])->name('log-activity-list');

        // Roles routes

        Route::get('role-list', [RoleController::class, 'index'])->name('role-list');
        Route::post('save-role', [RoleController::class, 'store'])->name('save-role');
        Route::get('role-create', [RoleController::class, 'create'])->name('role-create');
        Route::get('role-edit/{id}', [RoleController::class, 'edit'])->name('role-edit');
        Route::put('update-role', [RoleController::class, 'update'])->name('update-role');
        Route::get('/change-status/{id}', [RoleController::class, 'activation'])->name('change-status');
        Route::get('role-delete/{id}', [RoleController::class, 'destroy'])->name('role-delete');

        // Users routes

        Route::post('check-email-availability', [UserController::class, 'checkEmailAvailability'])->name('check-email-availability');
        Route::get('user-list', [UserController::class, 'list'])->name('user-list');
        Route::get('user-create', [UserController::class, 'index'])->name('user-create');
        Route::post('save-user', [UserController::class, 'store'])->name('save-user');
        Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
        Route::put('update-user', [UserController::class, 'update'])->name('update-user');
        Route::get('changestatus-user/{id}', [UserController::class, 'activation'])->name('changestatus-user');
        Route::get('user-delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
        Route::get('profile-edit/{id}', [UserController::class, 'editProfile'])->name('profile-edit');
        Route::put('update-profile', [UserController::class, 'updateProfile'])->name('update-profile');

        Route::get('driver-applicant-list', [DriverApplicantController::class, 'list'])->name('driver-applicant-list');
        Route::get('view-driver-applicant/{id}', [DriverApplicantController::class, 'view'])->name('view-driver-applicant');
        Route::post('send-driver-approvel', [DriverApplicantController::class, 'sendApprovel'])->name('send-driver-approvel');
        Route::post('action-driver-approvel', [DriverApplicantController::class, 'action'])->name('action-driver-approvel');
        Route::post('save-driver-action', [DriverApplicantController::class, 'saveAction'])->name('save-driver-action');

        Route::get('instructor-applicant-list', [InstructorApplicantController::class, 'list'])->name('instructor-applicant-list');
        Route::get('view-instructor-applicant/{id}', [InstructorApplicantController::class, 'view'])->name('view-instructor-applicant');
        Route::post('send-instructor-approvel', [InstructorApplicantController::class, 'sendApprovel'])->name('send-instructor-approvel');
        Route::post('action-instructor-approvel', [InstructorApplicantController::class, 'action'])->name('action-instructor-approvel');
        Route::post('save-instructor-action', [InstructorApplicantController::class, 'saveAction'])->name('save-instructor-action');

        Route::get('mechanic-applicant-list', [MechanicApplicantController::class, 'list'])->name('mechanic-applicant-list');
        Route::get('view-mechanic-applicant/{id}', [MechanicApplicantController::class, 'view'])->name('view-mechanic-applicant');
        Route::post('send-mechanic-approvel', [MechanicApplicantController::class, 'sendApprovel'])->name('send-mechanic-approvel');
        Route::post('action-mechanic-approvel', [MechanicApplicantController::class, 'action'])->name('action-mechanic-approvel');
        Route::post('save-mechanic-action', [MechanicApplicantController::class, 'saveAction'])->name('save-mechanic-action');
    });
});
