<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassesController extends Controller
{

    public static function getTurmas(Request $request): \Inertia\Response
    {
        return Inertia::render('Turmas',[
            'turmasValues' => Classes::query()
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
    }
}
