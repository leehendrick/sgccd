<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public static function index()
    {
        return Categories::all();
    }
}
