<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;

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
    return view('home');
});

Route::get('/admin', function () {
    return view('admin');
});


// Formulaire de login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/clients', [ClientController::class, 'store'])->name('admin.clients.store');
Route::put('/admin/clients/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
Route::delete('/admin/clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');

// routes/web.php
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'edit', 'show']);
});

Route::resource('subscriptions', \App\Http\Controllers\Admin\SubscriptionController::class)->names([
    'index' => 'subscriptions.index',
    'store' => 'subscriptions.store',
    'update' => 'subscriptions.update',
    'destroy' => 'subscriptions.destroy',
]);


// Dashboard protégé
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin'); // admin.blade.php
    })->name('admin.dashboard');

    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard-data', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard.data');


use App\Http\Controllers\LoginUserController;

Route::get('/', [LoginUserController::class, 'showLoginForm'])->name('user.login');
Route::post('/', [LoginUserController::class, 'login']);
Route::get('/logout', [LoginUserController::class, 'logout'])->name('user.logout');

Route::get('/dashboard', function () {
    $user = auth()->user();
    return view('client.dashboard', ['user' => $user]);
})->middleware('auth')->name('user.dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/client', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/client/parties', [ClientController::class, 'parties'])->name('client.parties');
    Route::get('/client/swot', [ClientController::class, 'swot'])->name('client.swot');
    Route::get('/client/processus', [ClientController::class, 'processus'])->name('client.processus');
    Route::get('/client/politique', [ClientController::class, 'politique'])->name('client.politique');
    Route::get('/client/raci', [ClientController::class, 'raci'])->name('client.raci');
    Route::get('/client/revu', [ClientController::class, 'revu'])->name('client.revu');
    Route::get('/client/risques', [ClientController::class, 'risques'])->name('client.risques');
    Route::get('/client/objectifs', [ClientController::class, 'objectifs'])->name('client.objectifs');
    Route::get('/client/docs', [ClientController::class, 'docs'])->name('client.docs');
    Route::get('/client/equipements', [ClientController::class, 'equipements'])->name('client.equipements');
    Route::get('/client/audits', [ClientController::class, 'audits'])->name('client.audits');
    Route::get('/client/capa', [ClientController::class, 'capa'])->name('client.capa');
    Route::get('/client/ia', [ClientController::class, 'ia'])->name('client.ia');
});