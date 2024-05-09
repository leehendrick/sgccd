<?php

use App\Http\Controllers\CursosController;
use App\Http\Controllers\ProfileController;
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

Route::post('inscricoes/create', function () {
    $attributes = request()->validate([
        'nome' => 'required | string |',
        'email' => 'required | string | email | unique:students,email',
        'bi' => 'required | string | size:14 | unique:students,bi',
        'data_nascimento' => 'required | string',
        'instituicao' => 'required | string',
        'area_formacao' => 'required | string',
        'data_inscricao' => 'required | string',
        'genero' => 'required | size:1 ',
        'telefone' => 'required',
        'curso_id' => 'required',
        'nivel_academico_id' => 'required',
    ]);
    Students::create($attributes);
});

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

Route::get('/solicitacoes', function (Request $request) {
    return Inertia::render('Solicitações',[
        'values' => Students::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('nome', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at', 'desc')
            ->paginate(6)
            ->withQueryString()
            /**->through(fn($student) => [
                //Aqui nós determinamos que campos da bd o props vai receber
            ])**/
        ,

        'filters' => $request->only(['search'])
    ]);
})->middleware(['auth', 'verified'])->name('solicitacoes');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cursos', function (Request $request) {
    return Inertia::render('Cursos',[
        'values' => Courses::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('nome', 'like', "%{$search}%");
            })
            ->paginate(3)
            ->withQueryString()
        /**->through(fn($student) => [
        //Aqui nós determinamos que campos da bd o props vai receber
        ])**/
        ,

        'filters' => $request->only(['search'])
    ]);
});

require __DIR__.'/auth.php';
