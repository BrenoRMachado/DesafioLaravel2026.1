<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'valor_unitario', 'quantidade', 'data_venda', 'comprador_id', 'vendedor_id', 'produto_id'
    ];
}
