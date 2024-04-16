<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'nome',
        'desricao',
        'duracao',
        'preco',
        'data_inicio',
        'data_termino',
        'local',
        'vagas',
        'requisitos',
        'status',
        'categories_id',
    ];
}
