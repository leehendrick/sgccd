<?php

namespace App\Http\Controllers;

use App\Models\Instrutores;
use Illuminate\Http\Request;

class InstrutorController extends Controller
{
    public function index(){
       return Instrutores::all();
    }
}
