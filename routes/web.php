<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('payment');
});

Route::post('/payment', [PaymentController::class, 'makePayment'])->name('payment.store');
