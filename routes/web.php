<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
   Route::middleware(Customer::class)->group(function () {
        Route::prefix('customer')->group(function () {
            Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        });
   });

   Route::middleware(Admin::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        });

    

    });


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
