<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/index', function () {
    return Inertia::render('Index');
})->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/alojamientos', function () {
    return Inertia::render('Alojamientos');
})->name('alojamientos');

Route::get('/vuelos', function () {
    return Inertia::render('Vuelos');
})->name('vuelos');

Route::get('/reservas', function () {
    return Inertia::render('Usuario/Reservas');
})->middleware(['auth', 'verified'])->name('reservas');

Route::get('/publicaciones', function () {
    return Inertia::render('Usuario/Publicaciones');
})->middleware(['auth', 'verified'])->name('publicaciones');

Route::get('/administracion', function () {
    return Inertia::render('Admin/Administracion');
})->middleware(['auth', 'verified'])->name('administracion');

require __DIR__.'/auth.php';
