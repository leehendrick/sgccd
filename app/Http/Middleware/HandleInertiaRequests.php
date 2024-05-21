<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\InstrutorController;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cursoController = new CursosController();
        $categoriaController = new CategoriaController();
        $formador = new InstrutorController();
        $horarios = new HorarioController();
        $cursos = $cursoController->index();
        $academicLevel = $cursoController->getAllAcademicLevel();
        //$cursosName = $cursos->pluck('nome', 'id');
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'cursos' => $cursos,
            'academic_level' => $academicLevel,
            'categorie' => $categoriaController->index(),
            'instrutor' => $formador->index(),
            'horarios' => $horarios->index()
        ];
    }
}
