<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('companies');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/company/update/{id}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');

});
