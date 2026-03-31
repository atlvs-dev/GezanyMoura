<?php

use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.admin.dashboard');
        })->name('dashboard');

        Route::resource('projects', ProjectController::class)->except(['show']);
    });
