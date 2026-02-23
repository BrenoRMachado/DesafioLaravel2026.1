<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function compras()
    {
        $compras = Order::with('produto')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.compras', compact('compras'));
    }

    public function vendas()
    {

        $vendas = Order::with('produto')
            ->whereHas('produto', function($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.vendas', compact('vendas'));
    }
}