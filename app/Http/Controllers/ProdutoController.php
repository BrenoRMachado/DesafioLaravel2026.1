<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request) 
    {
        $search = $request->input('search');

        $produtos = Produto::when($search, function ($query, $search) {
            return $query->where('nome', 'like', "%{$search}%");
        })->paginate(9)->withQueryString(); 

        return view('index', compact('produtos'));
    }
}