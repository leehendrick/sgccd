<?php

use App\Http\Controllers\CursosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use http\Client\Request;
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
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cursos' => CursosController::index(),
    ]);
});

Route::get('inscricoes', function () {
   return Inertia::render('Inscrições', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
   ]);
})->name('page.inscricoes');

Route::post('inscricoes', function () {
    return StudentController::store();
});

Route::get('inscricoes/{cursoId}', function ($id) {
    return CursosController::show($id);
})->name('cursos.show');

Route::get('contatos', function () {
   return Inertia::render('Contatos', [
       'canLogin' => Route::has('login'),
       'laravelVersion' => Application::VERSION,
       'phpVersion' => PHP_VERSION,
   ]);
})->name('page.contatos');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
