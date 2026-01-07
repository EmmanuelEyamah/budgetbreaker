<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('incomes', IncomeController::class)->only(['index', 'create', 'store', 'show']);
Route::resource('expenses', ExpenseController::class)->only(['index', 'create', 'store', 'show']);
