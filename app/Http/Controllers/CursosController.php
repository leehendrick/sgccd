<?php

namespace App\Http\Controllers;

use App\Models\AcademicLevel;
use App\Models\Courses;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CursosController extends Controller
{
    public static function courses(Request $request): \Inertia\Response
    {
        return Inertia::render('Cursos',[
            'values' => Courses::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('nome', 'like', "%{$search}%");
                })
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
        return Courses::where('status', '=', 'aberto')->get();
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

    public static function getAllAcademicLevel()
    {
        return AcademicLevel::all();
    }
}
