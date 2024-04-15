<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
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
