<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrganisationController;
use App\Http\Controllers\Admin\OrganisationStaffController;
use App\Http\Controllers\Admin\RoleController;
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
        Route::get('/dashboard', [DashboardController::class, 'superadmin'])
            ->middleware('permission:dashboard.view,admin')
            ->name('dashboard');

        Route::get('organisations', [OrganisationController::class, 'index'])
            ->middleware('permission:organisations.view,admin')
            ->name('organisations.index');
        Route::post('organisations', [OrganisationController::class, 'store'])
            ->middleware('permission:organisations.create,admin')
            ->name('organisations.store');
        Route::put('organisations/{organisation}', [OrganisationController::class, 'update'])
            ->middleware('permission:organisations.update,admin')
            ->name('organisations.update');
        Route::delete('organisations/{organisation}', [OrganisationController::class, 'destroy'])
            ->middleware('permission:organisations.delete,admin')
            ->name('organisations.destroy');

        Route::get('roles', [RoleController::class, 'index'])
            ->middleware('permission:roles.view,admin')
            ->name('roles.index');
        Route::post('roles', [RoleController::class, 'store'])
            ->middleware('permission:roles.create,admin')
            ->name('roles.store');
        Route::put('roles/{role}', [RoleController::class, 'update'])
            ->middleware('permission:roles.update,admin')
            ->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])
            ->middleware('permission:roles.delete,admin')
            ->name('roles.destroy');

        Route::get('staffs', [StaffController::class, 'index'])
            ->middleware('permission:staffs.view,admin')
            ->name('staffs.index');
        Route::post('staffs', [StaffController::class, 'store'])
            ->middleware('permission:staffs.create,admin')
            ->name('staffs.store');
        Route::put('staffs/{staff}', [StaffController::class, 'update'])
            ->middleware('permission:staffs.update,admin')
            ->name('staffs.update');
        Route::delete('staffs/{staff}', [StaffController::class, 'destroy'])
            ->middleware('permission:staffs.delete,admin')
            ->name('staffs.destroy');

        Route::get('leads', [LeadController::class, 'index'])
            ->middleware('permission:leads.view,admin')
            ->name('leads.index');
        Route::post('leads', [LeadController::class, 'store'])
            ->middleware('permission:leads.create,admin')
            ->name('leads.store');
        Route::put('leads/{lead}', [LeadController::class, 'update'])
            ->middleware('permission:leads.update,admin')
            ->name('leads.update');
        Route::delete('leads/{lead}', [LeadController::class, 'destroy'])
            ->middleware('permission:leads.delete,admin')
            ->name('leads.destroy');
    });

});

Route::middleware(['auth:web'])->group(function () {
    Route::middleware(['role:internal_staff,web'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staff'])
            ->middleware('permission:dashboard.view,web')
            ->name('dashboard');
        Route::get('staffs', [StaffController::class, 'index'])
            ->middleware('permission:staffs.view,web')
            ->name('staffs.index');
        Route::post('staffs', [StaffController::class, 'store'])
            ->middleware('permission:staffs.create,web')
            ->name('staffs.store');
        Route::put('staffs/{staff}', [StaffController::class, 'update'])
            ->middleware('permission:staffs.update,web')
            ->name('staffs.update');
        Route::delete('staffs/{staff}', [StaffController::class, 'destroy'])
            ->middleware('permission:staffs.delete,web')
            ->name('staffs.destroy');
        Route::get('leads', [LeadController::class, 'index'])
            ->middleware('permission:leads.view,web')
            ->name('leads.index');
        Route::post('leads', [LeadController::class, 'store'])
            ->middleware('permission:leads.create,web')
            ->name('leads.store');
        Route::put('leads/{lead}', [LeadController::class, 'update'])
            ->middleware('permission:leads.update,web')
            ->name('leads.update');
        Route::delete('leads/{lead}', [LeadController::class, 'destroy'])
            ->middleware('permission:leads.delete,web')
            ->name('leads.destroy');
    });

    Route::prefix('{organisation:slug}')->name('organisation.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'organisation'])
            ->middleware('permission:dashboard.view,web')
            ->name('dashboard');

        Route::middleware(['role:organisation_admin|organisation_staff,web'])->group(function () {
            Route::get('leads', [LeadController::class, 'index'])
                ->middleware('permission:leads.view,web')
                ->name('leads.index');
            Route::put('leads/{lead}', [LeadController::class, 'update'])
                ->middleware('permission:leads.update,web')
                ->name('leads.update');
        });

        Route::middleware(['role:organisation_admin|organisation_staff,web'])->group(function () {
            Route::get('staffs', [OrganisationStaffController::class, 'index'])
                ->middleware('permission:staffs.view,web')
                ->name('staffs.index');
            Route::post('staffs', [OrganisationStaffController::class, 'store'])
                ->middleware('permission:staffs.create,web')
                ->name('staffs.store');
        });

        Route::middleware(['role:organisation_admin,web'])->group(function () {
            Route::put('staffs/{staff}', [OrganisationStaffController::class, 'update'])
                ->middleware('permission:staffs.update,web')
                ->name('staffs.update');
            Route::delete('staffs/{staff}', [OrganisationStaffController::class, 'destroy'])
                ->middleware('permission:staffs.delete,web')
                ->name('staffs.destroy');
            Route::post('leads', [LeadController::class, 'store'])
                ->middleware('permission:leads.create,web')
                ->name('leads.store');
            Route::delete('leads/{lead}', [LeadController::class, 'destroy'])
                ->middleware('permission:leads.delete,web')
                ->name('leads.destroy');
        });
    });
});

Route::view('/', 'index')->name('index');
Route::view('/add-leads', 'add-leads')->name('add-leads');
Route::view('/invoice-list', 'invoice-list')->name('invoice-list');
Route::view('/notification', 'notification')->name('notification');
Route::view('/profile', 'profile')->name('profile');
Route::view('/settings', 'settings')->name('settings');
