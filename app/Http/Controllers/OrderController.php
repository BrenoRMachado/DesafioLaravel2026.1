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
        $vendas = Order::with('produto', 'comprador')
            ->whereHas('produto', function($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $chartData = $this->getVendasChartData();

        return view('orders.vendas', compact('vendas', 'chartData'));
    }

    private function getVendasChartData()
    {
        $meses = [];
        $dados = [];

        for ($i = 11; $i >= 0; $i--) {
            $data = now()->subMonths($i);
            $meses[] = $data->format('M/Y');
            
            $quantidade = Order::whereHas('produto', function($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->whereYear('created_at', $data->year)
            ->whereMonth('created_at', $data->month)
            ->count();
            
            $dados[] = (int)$quantidade;
        }

        return [
            'meses' => json_encode($meses, JSON_UNESCAPED_UNICODE),
            'dados' => json_encode($dados, JSON_UNESCAPED_UNICODE),
        ];
    }
}