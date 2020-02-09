<?php

use App\Announcement;
use App\Http\Actions\WalletActions\Deposit;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CoinDealController;
use App\Http\Controllers\CoinHistoryController;
use App\Http\Controllers\Deposit as ControllersDeposit;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\NairaHistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\StakeController;
use App\Http\Controllers\StakeTypeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 200;
});

//Open Auth Routes

Route::post('/register', [AuthenticationController::class, 'register'])->name('user.register');

Route::get('/verify-email/{token}', [AuthenticationController::class, 'validateEmail'])->name('user.verify');

Route::post('/verify-email-resend', [AuthenticationController::class, 'resendValidateEmail'])->name('user.reverify');

Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('user.forgot-password');

Route::post('/reset-password/{token}', [AuthenticationController::class, 'resetPassword'])->name('user.reset-password');


Route::post('/login', [AuthenticationController::class, 'login'])->name('user.login');

Route::group(['middleware' => ['encrypt', 'jwt.verify', 'email.verify']], function () {

    // Route::get('/activity', [AuthenticationController::class, 'getUser'])->name('user.get');

    Route::get('/user', [AuthenticationController::class, 'getUser'])->name('user.get');
    Route::get('/profile', [AuthenticationController::class, 'getUserProfile'])->name('profile.get');

    Route::name('notification.')->prefix('notification')->group(function () {
        Route::get('/get', [NotificationController::class, 'get'])->name('get');
        Route::post('/read', [NotificationController::class, 'read'])->name('read');
    });

    Route::post('/deposit', [ControllersDeposit::class, 'deposit'])->name('deposit');

    Route::name('stake.')->prefix('stake')->group(function () {
        Route::get('/get', [StakeTypeController::class, 'get'])->name('get');
        Route::post('/create', [StakeController::class, 'stake'])->name('create');
        Route::post('/pay', [StakeController::class, 'payWinner'])->name('pay');
        Route::post('/validate', [StakeController::class, 'validateStake'])->name('validate');
    });

    Route::name('history.')->prefix('history')->group(function () {
        Route::get('/naira/get', [NairaHistoryController::class, 'getUser'])->name('naira.get');
    });

    Route::name('announcement.')->prefix('announcement')->group(function () {
        Route::get('/getall', [Announcement::class, 'getAll'])->name('getall');
    });

    Route::name('transactions.')->prefix('transactions')->group(function () {
        Route::get('/get', [TransactionController::class, 'get'])->name('get');
    });
});

Route::group(['middleware' => ['jwt.verify', 'admin']], function () {
    Route::name('admin.')->prefix('admin')->group(function () {

        Route::name('history.')->prefix('history')->group(function () {
            Route::get('/naira/get', [NairaHistoryController::class, 'getAll'])->name('naira.get');
        });

        Route::name('stake.')->prefix('stake')->group(function () {
            Route::get('/get', [StakeTypeController::class, 'get'])->name('get');
            Route::post('/create', [StakeTypeController::class, 'create'])->name('create');
        });

        Route::name('notification.')->prefix('notification')->group(function () {
            Route::post('/create', [NotificationController::class, 'create'])->name('create');
            Route::get('/getall', [NotificationController::class, 'getAll'])->name('getall');
        });

        Route::name('announcement.')->prefix('announcement')->group(function () {
            Route::post('/create', [Announcement::class, 'create'])->name('create');
            Route::get('/getall', [Announcement::class, 'getAll'])->name('getall');
        });

        Route::name('transactions.')->prefix('transactions')->group(function () {
            Route::get('/getAll', [TransactionController::class, 'getAll'])->name('get');
        });

        Route::name('user.')->prefix('user')->group(function () {
        });
    });
});

Route::group(['middleware' => ['jwt.verify', 'super.admin']], function () {
    Route::name('super.')->prefix('super')->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {
            Route::post('/register', [AuthenticationController::class, 'createAdmin'])->name('user.register');
        });
    });
});

Route::post('/paystack/update', [TransactionController::class, 'paystackWebhook'])->name('paystack.webhook');

Route::group(['middleware' => ['jwt.fresh']], function () {
    Route::get('/refresh-token', [AuthenticationController::class, 'refreshToken'])->name('user.refresh');
});
