<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTypesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users
Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Product Types
Route::get('product-types', [ProductTypesController::class, 'index'])
  ->name('product-types')
  ->middleware('auth');

Route::get('product-types/create', [ProductTypesController::class, 'create'])
  ->name('product-types.create')
  ->middleware('auth');

Route::post('product-types', [ProductTypesController::class, 'store'])
  ->name('product-types.store')
  ->middleware('auth');

Route::get('product-types/{productType}/edit', [ProductTypesController::class, 'edit'])
  ->name('product-types.edit')
  ->middleware('auth');

Route::put('product-types/{productType}', [ProductTypesController::class, 'update'])
  ->name('product-types.update')
  ->middleware('auth');

Route::delete('product-types/{productType}', [ProductTypesController::class, 'destroy'])
  ->name('product-types.destroy')
  ->middleware('auth');

Route::put('product-types/{productType}/restore', [ProductTypesController::class, 'restore'])
  ->name('product-types.restore')
  ->middleware('auth');

// Products
Route::get('products', [ProductsController::class, 'index'])
  ->name('products')
  ->middleware('auth');

Route::get('products/create', [ProductsController::class, 'create'])
  ->name('products.create')
  ->middleware('auth');

Route::post('products', [ProductsController::class, 'store'])
  ->name('products.store')
  ->middleware('auth');

Route::get('products/{product}/edit', [ProductsController::class, 'edit'])
  ->name('products.edit')
  ->middleware('auth');

Route::put('products/{product}', [ProductsController::class, 'update'])
  ->name('products.update')
  ->middleware('auth');

Route::delete('products/{product}', [ProductsController::class, 'destroy'])
  ->name('products.destroy')
  ->middleware('auth');

Route::put('products/{product}/restore', [ProductsController::class, 'restore'])
  ->name('products.restore')
  ->middleware('auth');

// Sales
Route::get('sales', [SalesController::class, 'index'])
  ->name('sales')
  ->middleware('auth');

Route::get('sales/create', [SalesController::class, 'create'])
  ->name('sales.create')
  ->middleware('auth');

Route::post('sales', [SalesController::class, 'store'])
  ->name('sales.store')
  ->middleware('auth');

Route::get('sales/{sale}/edit', [SalesController::class, 'edit'])
  ->name('sales.edit')
  ->middleware('auth');

Route::put('sales/{sale}', [SalesController::class, 'update'])
  ->name('sales.update')
  ->middleware('auth');

Route::delete('sales/{sale}', [SalesController::class, 'destroy'])
  ->name('sales.destroy')
  ->middleware('auth');

Route::put('sales/{sale}/restore', [SalesController::class, 'restore'])
  ->name('sales.restore')
  ->middleware('auth');

// Reports
Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

Route::get('settings', [SettingController::class, 'index'])
    ->name('settings')
    ->middleware('auth');


    Route::get('settings/create', [SettingController::class, 'create'])
    ->name('settings.create')
    ->middleware('auth');
  
  Route::post('settings', [SettingController::class, 'store'])
    ->name('settings.store')
    ->middleware('auth');
  
  Route::get('settings/{setting}/edit', [SettingController::class, 'edit'])
    ->name('settings.edit')
    ->middleware('auth');
  
  Route::put('settings/{setting}', [SettingController::class, 'update'])
    ->name('settings.update')
    ->middleware('auth');
  
  Route::delete('settings/{setting}', [SettingController::class, 'destroy'])
    ->name('settings.destroy')
    ->middleware('auth');

// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
