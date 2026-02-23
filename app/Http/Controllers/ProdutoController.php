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

        $produtos = Produto::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', "%{$search}%");
            })
            ->when($categoriaSelecionada, function ($query, $categoriaSelecionada) {
                return $query->where('categoria', $categoriaSelecionada);
            })
            ->paginate(9)
            ->withQueryString();

        $chartData = $this->getProductsChartData();

        if ($request->is('produtos*')) {
            return view('produtos', compact('produtos', 'categorias', 'chartData'));
        }

        return view('index', compact('produtos', 'categorias', 'chartData'));
    }

    private function getProductsChartData()
    {
        $meses = [];
        $dados = [];

        for ($i = 11; $i >= 0; $i--) {
            $data = now()->subMonths($i);
            $meses[] = $data->format('M/Y');
            
            $quantidade = Produto::whereYear('data_criacao', $data->year)
                ->whereMonth('data_criacao', $data->month)
                ->count();
            
            $dados[] = $quantidade;
        }

        return [
            'meses' => json_encode($meses),
            'dados' => json_encode($dados),
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'required|string',
            'categoria' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['usuario_id'] = auth()->id();
        $data['data_criacao'] = now(); 

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produtos', 'public');
        }

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