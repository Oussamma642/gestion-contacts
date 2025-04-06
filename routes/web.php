<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShareController;
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
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ContactController::class, 'index'])->name('dashboard');
    Route::get('/related-contacts/{id}', [ContactController::class, 'relatedContacts'])->name('persons.RelatedPersons');
    Route::resource('contacts', ContactController::class);
    // Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/export-contacts', [ContactController::class, 'exportToExcel'])->name('export.contacts');

    // Routes for sharing contacts:
    Route::post('/share', [ShareController::class, 'share'])->name('share.contacts');
    Route::post('/share/update-status', [ShareController::class, 'updateStatus'])->name('share.updateStatus');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');