<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\DeactivateController;
use App\Http\Controllers\Account\Subscription\SubscriptionCancelController;
use App\Http\Controllers\Account\Subscription\SubscriptionCardController;
use App\Http\Controllers\Account\Subscription\SubscriptionResumeController;
use App\Http\Controllers\Account\Subscription\SubscriptionSwapController;
use App\Http\Controllers\Account\Subscription\SubscriptionTeamController;
use App\Http\Controllers\Account\Subscription\SubscriptionTeamMemberController;
use App\Http\Controllers\Account\TwoFactorController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\ActivationResendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Subscription\PlanController;
use App\Http\Controllers\Subscription\PlanTeamController;
use App\Http\Controllers\Subscription\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/token',function (){
    $token = auth()->user()->generateConfirmationToken();

   dd($token);
});

Route::get('/', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::group(['middleware' => ['auth','admin'],'prefix' => 'admin','as' => 'admin.'],function (){
    Route::get('/impersonate',[ImpersonateController::class,'index']);
    Route::post('/impersonate',[ImpersonateController::class,'store'])->name('impersonate.store');

});
Route::delete('/admin/impersonate',[ImpersonateController::class,'destroy'])->name('admin.impersonate.destroy');
Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.','namespace' => 'Account'], function (){

Route::get('/', [AccountController::class,'index'])->name('index');
Route::get('/deactivate', [DeactivateController::class,'index'])->name('deactivate.index');
Route::post('/deactivate', [DeactivateController::class,'store'])->name('deactivate.store');
    Route::group([] ,function (){
        Route::get('/twofactor', [TwoFactorController::class,'index'])->name('twofactor.index');
        Route::post('/twofactor', [TwoFactorController::class,'store'])->name('twofactor.store');
    });
Route::group(['prefix' => 'subscription', 'namespace' => 'Subscription'], function (){
    Route::group(['middleware' => 'subscription.cancelled'] ,function (){
        Route::get('/cancel', [SubscriptionCancelController::class,'index'])->name('subscription.cancel.index');
        Route::post('/cancel', [SubscriptionCancelController::class,'store'])->name('subscription.cancel.store');
    });



    Route::group(['middleware' => 'subscription.customer'] ,function (){
        Route::get('/card', [SubscriptionCardController::class,'index'])->name('subscription.card.index');
        Route::post('/card', [SubscriptionCardController::class,'store'])->name('subscription.card.store');
    });
    Route::group(['middleware' => 'subscription.cancelled'] ,function (){
        Route::get('/swap', [SubscriptionSwapController::class,'index'])->name('subscription.swap.index');
        Route::post('/swap', [SubscriptionSwapController::class,'store'])->name('subscription.swap.store');
    });
    Route::group(['middleware' => 'subscription.notcancelled'] ,function (){
        Route::get('/resume', [SubscriptionResumeController::class,'index'])->name('subscription.resume.index');
        Route::post('/resume', [SubscriptionResumeController::class,'store'])->name('subscription.resume.store');

    });

    Route::group(['middleware' => ['subscription.team']] ,function (){
        Route::get('/team', [SubscriptionTeamController::class,'index'])->name('subscription.team.index');
        Route::patch('/team', [SubscriptionTeamController::class,'update'])->name('subscription.team.update');

        Route::post('/team/member', [SubscriptionTeamMemberController::class,'store'])->name('subscription.team.member.store');
        Route::delete('/team/member/{user}', [SubscriptionTeamMemberController::class,'destroy'])->name('subscription.team.member.destroy');
    });

    });

});
//account activation
Route::group(['prefix' => 'activation', 'as' => 'activation.','middleware' => ['guest']], function (){
    Route::get('/resend', [ActivationResendController::class,'index'])->name('resend');
    Route::post('/resend', [ActivationResendController::class,'store'])->name('resend.store');
    Route::get('/{token}', [ActivationController::class,'activate'])->name('activate');
});

//account activation
Route::group(['prefix' => 'plans','as' => 'plans.', 'middleware' => 'subscription.inactive'], function (){
    Route::get('/', [PlanController::class,'index'])->name('index');
    Route::get('/teams', [PlanTeamController::class,'index'])->name('teams.index');
});

//account activation
Route::group(['prefix' => 'subscription','as' => 'subscription.','middleware' => ['auth.register','subscription.inactive']], function (){
    Route::get('/', [SubscriptionController::class,'index'])->name('index');
    Route::post('/', [SubscriptionController::class,'store'])->name('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
