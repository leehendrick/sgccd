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
}
