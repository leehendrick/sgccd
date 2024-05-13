<?php

namespace App\Http\Controllers;

use App\Models\AcademicLevel;
use App\Models\Courses;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CursosController extends Controller
{
    public static function courses(Request $request): Response
    {
        return Inertia::render('Cursos',[
            'values' => Courses::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('nome', 'like', "%{$search}%");
                })
                ->orderByDesc('created_at', 'desc')
                ->paginate(5)
                ->withQueryString()
            /**->through(fn($student) => [
            //Aqui nós determinamos que campos da bd o props vai receber
            ])**/
            ,

            'filters' => $request->only(['search'])
        ]);
    }

    public static function index()
    {
        return Courses::where('status', '=', 'Disponível')->get();
    }

    public static function show($cursoId)
    {
        $curso  = Courses::find($cursoId);
        if ($curso){
            return response()->json([$curso], status: 200);
        }
        else{
            return response()->json(['ERROR' => 'Nenhum curso encontrado'], status: 404);
        }

    }

    public static function store(Request $request)
    {
        $request->validate([
            'nome' => 'required | unique:'.Courses::class,
            'descricao' => 'required|string',
            'duracao' => 'required|string',
            'preco' => 'required',
            'data_inicio' => 'required',
            'data_termino' => 'required',
            'local' => 'required|string',
            'vagas' => 'required|integer|min:10|max:50',
            'requisitos' => 'required',
            'status' => 'required|string',
            'categories_id' => 'required|integer',

        ]);

        Courses::create($request->all());
        return Inertia::render('Cursos');
    }

    public static function edit($id): Response
    {
        $curso = Courses::findOrFail($id);
        return inertia::render('Cursos',['cursoEdit' => $curso]);
    }

    public static function update(Request $request, $id)
    {

    }

    public static function getAllAcademicLevel()
    {
        return AcademicLevel::all();
    }
}
