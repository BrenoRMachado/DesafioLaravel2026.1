<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoriaSelecionada = $request->input('categoria');

        $categorias = Produto::select('categoria')->distinct()->pluck('categoria');

        $produtos = Produto::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', "%{$search}%");
            })
            ->when($categoriaSelecionada, function ($query, $categoriaSelecionada) {
                return $query->where('categoria', $categoriaSelecionada);
            })
            ->paginate(9)
            ->withQueryString();

        return view('index', compact('produtos', 'categorias'));
    }
}