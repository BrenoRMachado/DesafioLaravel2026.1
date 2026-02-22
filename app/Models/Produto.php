<?php

namespace App\Models; // CORREÇÃO: Removido o "App\" extra

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;
    
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