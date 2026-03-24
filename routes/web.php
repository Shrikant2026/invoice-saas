<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\AdminController;

Route::middleware(['auth', 'admin'])
->prefix('admin')
->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])
    ->name('admin.users');

    Route::get('/invoices', [AdminController::class, 'invoices'])
    ->name('admin.invoices');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])
    ->name('admin.payments');

    Route::post('/payments/{id}/approve', 
        [PaymentController::class, 'approve'])
        ->name('admin.payments.approve');

    // User plan update
    Route::post('/users/{user}/plan', 
        [AdminController::class, 'updateUserPlan'])
        ->name('admin.user.plan');


    Route::get('/payments', [AdminPaymentController::class,'index'])
    ->name('admin.payments');

    Route::post('/payments/{id}/approve', [AdminPaymentController::class,'approve'])
    ->name('admin.payments.approve');

    Route::post('/payments/{id}/reject', [AdminPaymentController::class,'reject'])
    ->name('admin.payments.reject');

});


Route::post('/payment/request/{plan}', [PaymentController::class,'request'])
    ->name('payment.request');

Route::get('/payment/{plan}', [PaymentController::class,'request'])
->name('payment.page');

Route::post('/payment/confirm', [PaymentController::class,'confirm'])
->name('payment.confirm');

use App\Http\Controllers\ClientController;

Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class);
});

use App\Http\Controllers\InvoiceController;

Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
});

use App\Http\Controllers\Auth\SocialController;

Route::get('/auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('/auth/github', [SocialController::class, 'redirectToGithub']);
Route::get('/auth/github/callback', [SocialController::class, 'handleGithubCallback']);

Route::get('/subscription', function () {
    return view('subscription.index');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/subscribe/{plan}', [SubscriptionController::class, 'subscribe'])
        ->name('subscribe');
});

use App\Http\Controllers\SubscriptionController;

Route::get('/subscribe/{plan}', [SubscriptionController::class, 'subscribe'])
    ->name('subscribe')
    ->middleware('auth');

use App\Http\Controllers\PricingController;

Route::middleware('auth')->group(function () {
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
});

Route::get('/upgrade/{plan}', [PaymentController::class, 'upgrade'])
    ->name('upgrade');

require __DIR__.'/auth.php';
