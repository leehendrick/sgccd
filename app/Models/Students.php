<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'bi',
        'data_nascimento',
        'instituicao',
        'area_formacao',
        'data_inscricao',
        'genero',
        'telefone',
    ];
}
