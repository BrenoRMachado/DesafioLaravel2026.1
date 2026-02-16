<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome', 
        'preco', 
        'foto', 
        'quantidade', 
        'descricao', 
        'categoria', 
        'data_criacao', 
        'usuario_id',
    ];

   public function vendedor()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    } 
}
