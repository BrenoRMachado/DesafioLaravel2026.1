<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $fillable = [
        'quantidade', 'usuario_id', 'produto_id'
    ];
}
