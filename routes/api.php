<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RentalContoller;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\GarageController;
use App\Http\Controllers\Api\EmbassieController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CodeCheckController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\VisaProcesseController;
use App\Http\Controllers\Api\PoliceStationController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LocationBaseAlertController;
use App\Http\Controllers\Api\TransportationBusController;
use App\Http\Controllers\Api\TransportationTaxiController;
use App\Http\Controllers\Api\TouristBoardContactController;
use App\Http\Controllers\Api\TransportationTrainController;
use App\Http\Controllers\Api\TransportationBookingController;
use App\Http\Controllers\Api\TransportationJeepTourController;
use App\Http\Controllers\Api\DepartmentofImmigrationController;


Route::post('/login', [LoginController::class, 'login'])->name('api.login');

Route::post('/register', [RegisterController::class, 'store'])->name('api.register');

Route::post('password/email', [ForgotPasswordController::class, 'emailSend'] )->name('api.email-send');

Route::post('password/code/check', [CodeCheckController::class, 'checkCode']);

Route::post('password/reset', [ResetPasswordController::class, 'resetPassword']);

Route::middleware(['auth:sanctum', 'apirole:free'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('api.logout');

    Route::prefix('customer')->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('api-index');
        Route::get('/{id}', [LoginController::class, 'show'])->name('api-show');
        Route::put('/{id}', [LoginController::class, 'update'])->name('api-update');
        Route::delete('/{id}', [LoginController::class, 'destroy'])->name('api-destroy');
    });

    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('api-index');
        Route::get('/{id}', [BannerController::class, 'show'])->name('api-show');
    });

    Route::prefix('emergency')->group(function () {

        Route::prefix('hospital')->group(function () {
            Route::get('/', [HospitalController::class, 'index'])->name('api-index');
            Route::get('/{id}', [HospitalController::class, 'show'])->name('api-show');
            Route::post('/nearest-hospital', [HospitalController::class, 'getNearestHospitalList'])->name('api-get-nearest-hospital');
        });

        Route::prefix('police-station')->group(function () {
            Route::get('/', [PoliceStationController::class, 'index'])->name('api-index');
            Route::get('/{id}', [PoliceStationController::class, 'show'])->name('api-show');
            Route::post('/nearest-police-station', [PoliceStationController::class, 'getNearestPoliceStationList'])->name('api-get-nearest');
        });

        Route::prefix('garage')->group(function () {
            Route::get('/', [GarageController::class, 'index'])->name('api-index');
            Route::get('/{id}', [GarageController::class, 'show'])->name('api-show');
            Route::post('/nearest-garage', [GarageController::class, 'getNearestGarageList'])->name('api-get-nearest-garage');

        });

        Route::prefix('tourist-board-contact')->group(function () {
            Route::get('/', [TouristBoardContactController::class, 'index'])->name('api-index');
            Route::get('/{id}', [TouristBoardContactController::class, 'show'])->name('api-show');
        });
        
    });

    Route::prefix('alert')->group(function () {
        Route::post('/', [LocationBaseAlertController::class, 'index'])->name('api-index');
    });

    Route::prefix('tourists-information')->group(function () {

        Route::prefix('department-of-immigration')->group(function () {
            Route::get('/', [DepartmentofImmigrationController::class, 'index'])->name('api-index');
            Route::get('/{id}', [DepartmentofImmigrationController::class, 'show'])->name('api-show');
        });

        Route::prefix('embassies')->group(function () {
            Route::get('/', [EmbassieController::class, 'index'])->name('api-index');
            Route::get('/{id}', [EmbassieController::class, 'show'])->name('api-show');
        });

        Route::prefix('visa-process')->group(function () {
            Route::get('/', [VisaProcesseController::class, 'index'])->name('api-index');
            Route::get('/{id}', [VisaProcesseController::class, 'show'])->name('api-show');
        });

    });

    Route::prefix('transportation')->group(function () {

        Route::prefix('booking')->group(function () {
            Route::get('/', [TransportationBookingController::class, 'index'])->name('api-index');
        });

        Route::prefix('taxi')->group(function () {
            Route::get('/', [TransportationTaxiController::class, 'index'])->name('api-index');
        });

        Route::prefix('rental')->group(function () {
            Route::get('/', [RentalContoller::class, 'index'])->name('api-index');
            Route::get('/{id}', [RentalContoller::class, 'show'])->name('api-show');
        });
    });

    Route::prefix('discover-sri-lanka')->group(function () {

        Route::prefix('destination')->group(function () {
            Route::get('/', [DestinationController::class, 'index']);
            Route::get('/{id}', [DestinationController::class, 'show']);

        });
    });
});

