<?php

namespace App\Http\Controllers;

use App\Models\Courses;

class CursosController extends Controller
{
    //
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
}
