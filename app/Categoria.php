<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        'id',
        'nome',
        'status',
        //fk
        'empresa_id',
        'usuario_id'
    ];
    protected $table = 'cargo';
}
