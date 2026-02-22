<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoriaSelecionada = $request->input('categoria');
        
        $categorias = Produto::select('categoria')->distinct()->pluck('categoria');

        // Se a rota for a de administração, usamos uma view; se for a home, outra.
        // Vou assumir que você vai usar a rota 'produtos.index' para o gerenciamento.
        $produtos = Produto::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', "%{$search}%");
            })
            ->when($categoriaSelecionada, function ($query, $categoriaSelecionada) {
                return $query->where('categoria', $categoriaSelecionada);
            })
            ->paginate(9)
            ->withQueryString();

        // Verifica se a URL contém 'admin' ou se você prefere separar por nome de rota
        if ($request->is('produtos*')) {
            return view('produtos', compact('produtos', 'categorias'));
        }

        return view('index', compact('produtos', 'categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'required|string',
            'categoria' => 'required|string',
            'data_criacao' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produtos', 'public');
        }

        $data['usuario_id'] = auth()->id();

        Produto::create($data);

        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'required|string',
            'categoria' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Deleta a foto antiga se existir
            if ($produto->foto) {
                Storage::disk('public')->delete($produto->foto);
            }
            $data['foto'] = $request->file('foto')->store('produtos', 'public');
        }

        $produto->update($data);

        return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->foto) {
            Storage::disk('public')->delete($produto->foto);
        }

        $produto->delete();

        return redirect()->back()->with('success', 'Produto removido com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }
}