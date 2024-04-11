<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CursosController;
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
        $cursos = $cursoController->index();
        //$cursosName = $cursos->pluck('nome', 'id');
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'cursos' => $cursos,
        ];
    }
}
