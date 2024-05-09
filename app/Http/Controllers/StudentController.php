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
    public static function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'bi' => 'required',
            'data_nascimento' => 'required',
            'instituicao' => 'required',
            'area_formacao' => 'required',
            'data_inscricao' => 'required',
            'genero' => 'required',
            'telefone' => 'required'
        ]);

        return Students::create($request->all());
    }
}
