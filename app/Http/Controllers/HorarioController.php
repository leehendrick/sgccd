<?php

namespace App\Http\Controllers;

use App\Models\Horarios;

class HorarioController extends Controller
{
    public function index(){
        return Horarios::all();
    }
}
