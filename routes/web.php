<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\Courses;
use App\Models\Students;
use Illuminate\Http\Request;
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

//Rota para inscrições
Route::get('inscricoes', function () {
   return Inertia::render('Inscrições', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
   ]);
})->name('page.inscricoes');

Route::post('inscricoes', [
    StudentController::class, 'store'
]);

Route::get('inscricoes/{cursoId}', function ($id) {
    return CursosController::show($id);
})->name('cursos.show');

//Rotas para contatos
Route::get('contatos', function () {
   return Inertia::render('Contatos', [
       'canLogin' => Route::has('login'),
       'laravelVersion' => Application::VERSION,
       'phpVersion' => PHP_VERSION,
   ]);
})->name('page.contatos');

//Rotas...
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/solicitacoes', [
    StudentController::class, 'solicitacoes'
])->middleware(['auth', 'verified'])->name('solicitacoes');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cursos', [CursosController::class, 'courses'])->name('cursos');
    Route::get('/cursos/edit', [CursosController::class, 'edit'])->name('cursos.edit');
    Route::post('/cursos/create', [CursosController::class, 'store'])->name('cursos.store');
    Route::patch('/cursos/{id}', [CursosController::class, 'update'])->name('cursos.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('turmas', [ClassesController::class, 'getTurmas'])->name('turmas.index');
});


require __DIR__.'/auth.php';
