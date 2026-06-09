<?php

use App\Http\Controllers\Admin\ApprovedDriverController;
use App\Http\Controllers\Admin\ApprovedInstructorController;
use App\Http\Controllers\Admin\ApprovedMechanicController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DriverApplicantController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\InstructorApplicantController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\Masterdata\BranchController;
use App\Http\Controllers\Admin\Masterdata\CityController;
use App\Http\Controllers\Admin\Masterdata\ServiceFeeController;
use App\Http\Controllers\Admin\Masterdata\VehicleController;
use App\Http\Controllers\Admin\Masterdata\VehicleTypeController;
use App\Http\Controllers\Admin\MechanicApplicantController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

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

        Route::get('branches-list', [BranchController::class, 'list'])->name('branches-list');
        Route::get('branches-create', [BranchController::class, 'index'])->name('branches-create');
        Route::post('save-branches', [BranchController::class, 'store'])->name('save-branches');
        Route::get('branches-edit/{id}', [BranchController::class, 'edit'])->name('branches-edit');
        Route::put('update-branches', [BranchController::class, 'update'])->name('update-branches');
        Route::get('changestatus-branches/{id}', [BranchController::class, 'activation'])->name('changestatus-branches');
        Route::get('branches-delete/{id}', [BranchController::class, 'destroy'])->name('branches-delete');

        Route::get('cities-list', [CityController::class, 'list'])->name('cities-list');
        Route::get('cities-create', [CityController::class, 'index'])->name('cities-create');
        Route::post('save-cities', [CityController::class, 'store'])->name('save-cities');
        Route::get('cities-edit/{id}', [CityController::class, 'edit'])->name('cities-edit');
        Route::put('update-cities', [CityController::class, 'update'])->name('update-cities');
        Route::get('changestatus-cities/{id}', [CityController::class, 'activation'])->name('changestatus-cities');
        Route::get('cities-delete/{id}', [CityController::class, 'destroy'])->name('cities-delete');

        Route::get('approved-driver-list', [ApprovedDriverController::class, 'list'])->name('approved-driver-list');
        Route::get('approved-instructor-list', [ApprovedInstructorController::class, 'list'])->name('approved-instructor-list');
        Route::get('approved-mechanic-list', [ApprovedMechanicController::class, 'list'])->name('approved-mechanic-list');

        Route::get('vehicle-type-list', [VehicleTypeController::class, 'list'])->name('vehicle-type-list');
        Route::get('vehicle-type-create', [VehicleTypeController::class, 'index'])->name('vehicle-type-create');
        Route::post('save-vehicle-type', [VehicleTypeController::class, 'store'])->name('save-vehicle-type');
        Route::get('vehicle-type-edit/{id}', [VehicleTypeController::class, 'edit'])->name('vehicle-type-edit');
        Route::put('update-vehicle-type', [VehicleTypeController::class, 'update'])->name('update-vehicle-type');
        Route::get('changestatus-vehicle-type/{id}', [VehicleTypeController::class, 'activation'])->name('changestatus-vehicle-type');
        Route::get('vehicle-type-delete/{id}', [VehicleTypeController::class, 'destroy'])->name('vehicle-type-delete');

        Route::get('vehicle-list', [VehicleController::class, 'list'])->name('vehicle-list');
        Route::get('vehicle-create', [VehicleController::class, 'index'])->name('vehicle-create');
        Route::post('save-vehicle', [VehicleController::class, 'store'])->name('save-vehicle');
        Route::get('vehicle-edit/{id}', [VehicleController::class, 'edit'])->name('vehicle-edit');
        Route::put('update-vehicle', [VehicleController::class, 'update'])->name('update-vehicle');
        Route::get('changestatus-vehicle/{id}', [VehicleController::class, 'activation'])->name('changestatus-vehicle');
        Route::get('vehicle-delete/{id}', [VehicleController::class, 'destroy'])->name('vehicle-delete');

        Route::get('service-fee-list', [ServiceFeeController::class, 'list'])->name('service-fee-list');
        Route::get('service-fee-create', [ServiceFeeController::class, 'index'])->name('service-fee-create');
        Route::post('save-service-fee', [ServiceFeeController::class, 'store'])->name('save-service-fee');
        Route::get('service-fee-edit/{id}', [ServiceFeeController::class, 'edit'])->name('service-fee-edit');
        Route::put('update-service-fee', [ServiceFeeController::class, 'update'])->name('update-service-fee');
        Route::get('changestatus-service-fee/{id}', [ServiceFeeController::class, 'activation'])->name('changestatus-service-fee');
        Route::get('service-fee-delete/{id}', [ServiceFeeController::class, 'destroy'])->name('service-fee-delete');

        Route::get('new-booking-list', [BookingController::class, 'list'])->name('new-booking-list');
        Route::get('view-booking-details/{id}', [BookingController::class, 'view'])->name('view-booking-details');
        Route::post('booking-action', [BookingController::class, 'saveAction'])->name('booking-action');
        Route::get('accepted-booking-list', [BookingController::class, 'acceptedList'])->name('accepted-booking-list');

        Route::get('new-trip-request-list', [DriverController::class, 'list'])->name('new-trip-request-list');
        Route::get('ongoing-trip-list', [DriverController::class, 'ongoingList'])->name('ongoing-trip-list');
        Route::get('completed-trip-list', [DriverController::class, 'completedList'])->name('completed-trip-list');
        Route::get('driver-availability-calendar', [DriverController::class, 'index'])->name('driver-availability-calendar');
        Route::post('save-driver-availability-calendar', [DriverController::class, 'store'])->name('save-driver-availability-calendar');

        Route::get('new-driving-session-request-list', [InstructorController::class, 'list'])->name('new-driving-session-request-list');
        Route::get('completed-driving-session-list', [InstructorController::class, 'completedList'])->name('completed-driving-session-list');
        Route::get('instructor-availability-calendar', [InstructorController::class, 'index'])->name('instructor-availability-calendar');
        Route::post('save-instructor-availability-calendar', [InstructorController::class, 'store'])->name('save-instructor-availability-calendar');
    });
});