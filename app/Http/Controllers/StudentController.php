<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public static function solicitacoes(Request $request): \Inertia\Response
    {
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
    }
    public static function store(Request $request): \Inertia\Response
    {
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
        return Inertia::render('Inscricoes');
    }
}
