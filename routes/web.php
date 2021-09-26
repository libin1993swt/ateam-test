<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventController as PublicEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('events-list');
});

Route::any('events-list',[PublicEventController::class, 'list'])->name('events.list');
Route::get('event/{id}', [PublicEventController::class, 'show'])->name('events.show');

Route::middleware(['auth'])->group(function () {
    Route::any('events', [EventController::class, 'index'])->name('events');
    Route::get('events/create',[EventController::class, 'create'])->name('events.create');
    Route::post('events/create',[EventController::class, 'store'])->name('events.store');
    Route::get('events/{id}/edit',[EventController::class, 'edit'])->name('events.edit');
    Route::patch('events/{id}',[EventController::class, 'update'])->name('events.update');

    Route::get('dashboard', [AuthController::class, 'dashboard']); 
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 




