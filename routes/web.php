<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\CustomerController::class, 'viewCustomerForm']);
Route::post('/customer-form-submit', [\App\Http\Controllers\CustomerController::class, 'submitCustomerForm'])->name('customer.store');
Route::get('/customer-export', [\App\Http\Controllers\AdminController::class, 'exportCustomerCsv'])->middleware(['auth'])->name('customer.export');
Route::post('/customer-create-wp-user', [\App\Http\Controllers\AdminController::class, 'createWPUser'])->middleware(['auth'])->name('customer.create.wpuser');
Route::get('/customer-profile/{id}', [\App\Http\Controllers\AdminController::class, 'showCustomerProfile'])->middleware(['auth'])->name('customer.profile.show');

Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
