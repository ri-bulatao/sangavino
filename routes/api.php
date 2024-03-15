<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Resident Restful Controllers
use App\Http\Controllers\Resident\{
    PaymayaController,
};



Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'resident', 'as' => 'resident.'],function() {
    Route::controller(PaymayaController::class)->group(function () {
        Route::get('payment-success', 'success')->name('paymaya.api.success');
        Route::get('failed-payment', 'webhook_failed')->name('paymaya.api.failed');
    });
});


