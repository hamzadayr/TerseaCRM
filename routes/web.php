<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\EntrepriseController;


Route::get('/', function () {
    return view('welcome');
});

// Routes pour les invités (utilisateurs non connectés)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login',  [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// Routes pour accepter une invitation (utilisateurs non connectés)
Route::get('/invitations/accept/{token}', [InvitationController::class, 'acceptInvitation'])->name('invitations.accept');
Route::post('/invitations/complete/', [InvitationController::class, 'completeInvitation'])->name('invitations.complete');

// Routes pour les employés connectés
Route::middleware(['auth', 'role:employe'])->group(function () {
    Route::get('/employee/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
    Route::post('/employee/profile/update', [EmployeeController::class, 'updateProfile'])->name('employee.profile.update');
});

// Routes pour les administrateurs connectés
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/all',[AdminController::class, 'adminList'])->name('admin.index');
    Route::post('/admin/addadmin',[AdminController::class, 'createAdmin'])->name('admin.add-admin');
    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin.employees');
    Route::get('/invitations/all', [InvitationController::class, 'index'])->name('admin.invitations');


    // Routes pour les invitations
    Route::post('/invitations/invite', [InvitationController::class, 'inviteEmployee'])->name('invitations.invite');
    Route::get('/invitations/cancel/{invitation}', [InvitationController::class, 'cancelInvitation'])->name('invitations.cancel');

    // Routes pour les entreprises
    Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.index');
    Route::get('/entreprises/all', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::post('/entreprises/store', [EntrepriseController::class, 'store'])->name('entreprises.store');
    Route::get('/entreprises/{entreprise}/edit', [EntrepriseController::class, 'edit'])->name('entreprises.edit');
    Route::put('/entreprises/{entreprise}/update', [EntrepriseController::class, 'update'])->name('entreprises.update');
    Route::delete('/entreprises/{entreprise}/destroy', [EntrepriseController::class, 'destroy'])->name('entreprises.destroy');
    
});
