<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrganisationController;
use App\Http\Controllers\Admin\OrganisationStaffController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/{organisation:slug}', [AuthController::class, 'showLoginForm'])->name('organisation.login');
Route::post('/{organisation:slug}', [AuthController::class, 'login'])->name('organisation.login.submit');

Route::middleware(['auth:admin'])->group(function () {

    // 1. Superadmin
    Route::middleware(['role:Super Admin,admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'superadmin'])->name('dashboard');
        Route::resource('organisations', OrganisationController::class)->except(['show', 'create', 'edit']);
        Route::resource('staffs', StaffController::class)->except(['show', 'create', 'edit'])->parameters([
            'staffs' => 'staff',
        ]);
        Route::resource('leads', LeadController::class)->only(['index', 'store', 'update', 'destroy']);
    });

});

Route::middleware(['auth:web'])->group(function () {
    Route::middleware(['role:internal_staff,web'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');
    });

    Route::middleware(['role:organisation_admin,web'])->name('organisation.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'organisationAdmin'])->name('dashboard');
        Route::resource('staffs', OrganisationStaffController::class)->only(['index', 'store', 'update', 'destroy'])->parameters([
            'staffs' => 'staff',
        ]);
        Route::resource('leads', LeadController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    Route::middleware(['role:organisation_staff,web'])->prefix('organisation-staff')->name('organisation-staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'organisationStaff'])->name('dashboard');
        Route::resource('leads', LeadController::class)->only(['index', 'update']);
    });
});

Route::view('/', 'index')->name('index');
Route::view('/add-leads', 'add-leads')->name('add-leads');
Route::view('/invoice-list', 'invoice-list')->name('invoice-list');
Route::view('/notification', 'notification')->name('notification');
Route::view('/profile', 'profile')->name('profile');
Route::view('/settings', 'settings')->name('settings');
Route::redirect('/add-organisation', '/admin/organisations')->name('add-organisation');
Route::redirect('/add-staff', '/admin/staffs')->name('add-staff');
Route::redirect('/organisation', '/admin/organisations')->name('organisation');
Route::redirect('/staffs', '/admin/staffs')->name('staffs');
Route::redirect('/leads', '/admin/leads')->name('leads');
