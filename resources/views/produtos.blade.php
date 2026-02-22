<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciamento de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-[#2f1c37] border-l-4 border-[#e8675c] p-4 rounded shadow-lg">
                    <strong class="text-[#e8675c] font-bold text-lg">Opa! Algo deu errado:</strong>
                    <ul class="mt-2 list-disc list-inside text-white text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Lista de Produtos</h1>
                <a href="#" onclick="openCreateModal(event)" class="px-4 py-2 bg-[#c91b7a] text-white rounded-md font-bold hover:opacity-90 transition">Cadastrar Produto</a>
            </div>

            <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52]">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full border-none">
                        <thead class="bg-[#482b52]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Categoria</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Preço</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Qtd</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#2f1c37] divide-y divide-[#482b52]">
                            @foreach($produtos as $produto)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <img src="{{ $produto->foto ? asset('storage/' . $produto->foto) : 'https://via.placeholder.com/40' }}" class="w-10 h-10 rounded object-cover border border-[#482b52]">
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $produto->nome }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $produto->categoria }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-[#ffca06] font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">
                                    <span class="{{ $produto->quantidade < 5 ? 'text-red-500 font-bold' : '' }}">
                                        {{ $produto->quantidade }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                    <a href="#" onclick="openViewModal(event, {{ $produto->id }})" class="text-[#ffca06] hover:opacity-80 mr-3 font-bold">Ver</a>
                                    <a href="#" onclick="openEditModal(event, {{ $produto->id }})" class="text-[#c91b7a] hover:opacity-80 mr-3 font-bold">Editar</a>
                                    <a href="#" onclick="openDeleteModal(event, {{ $produto->id }})" class="text-[#e8675c] hover:opacity-80 font-bold">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 px-4 py-3 border-t border-[#482b52] flex items-center justify-between">
                        <div class="text-sm text-white font-medium">
                            Mostrando <span class="font-bold text-white">{{ $produtos->firstItem() }}</span> 
                            até <span class="font-bold text-white">{{ $produtos->lastItem() }}</span> 
                            de <span class="font-bold text-white">{{ $produtos->total() }}</span> resultados
                        </div>
                        <div class="pagination-codevolt">
                            {{ $produtos->links() }}
                        </div>
                    </div>
                    <style>
                        .pagination-codevolt nav span[aria-current="page"] span { background-color: #e8675c; border-color: #e8675c; color: white; font-weight: bold; }
                        .pagination-codevolt nav a, .pagination-codevolt nav span { background-color: #2f1c37; color: white; border-color: #482b52; }
                        .pagination-codevolt nav a:hover { background-color: #482b52; color: #ffca06; }
                        .pagination-codevolt nav div:first-child p { display: none; }
                    </style>
                </div>
            </div>
        </div>
    </div>

    <div id="createModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Cadastrar Novo Produto</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="createForm" action="/produtos" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="nome" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-bold mb-2">Preço</label>
                        <input type="number" name="preco" step="0.01" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-bold mb-2">Quantidade</label>
                        <input type="number" name="quantidade" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Categoria</label>
                    <input type="text" name="categoria" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Descrição</label>
                    <textarea name="descricao" required rows="3" class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Data de Criação</label>
                    <input type="date" name="data_criacao" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Foto do Produto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-[#482b52] file:text-white hover:file:bg-[#5a3666]">
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition font-bold">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-[#c91b7a] text-white font-bold rounded-md hover:bg-[#a11562] transition shadow-lg">Salvar Produto</button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Detalhes do Produto</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="space-y-4">
                <div><label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Nome</label><input type="text" id="viewNome" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Preço</label><input type="text" id="viewPreco" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-[#ffca06]"></div>
                    <div><label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Estoque</label><input type="text" id="viewQuantidade" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-white"></div>
                </div>
                <div><label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Descrição</label><textarea id="viewDescricao" readonly rows="3" class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300"></textarea></div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeViewModal()" class="px-6 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition font-bold">Fechar</button>
            </div>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Editar Produto</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="nome" id="editNome" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md text-white focus:border-[#c91b7a] focus:outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Categoria</label>
                    <input type="text" name="categoria" id="editCategoria" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md text-white focus:border-[#c91b7a] focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-bold mb-2">Preço</label>
                        <input type="number" name="preco" id="editPreco" step="0.01" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md text-white">
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-bold mb-2">Quantidade</label>
                        <input type="number" name="quantidade" id="editQuantidade" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md text-white">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Descrição</label>
                    <textarea name="descricao" id="editDescricao" rows="3" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md text-white focus:border-[#c91b7a] focus:outline-none"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Trocar Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-400 file:bg-[#482b52] file:text-white file:border-0 file:py-2 file:px-4 file:rounded-md cursor-pointer">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] font-bold">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-[#c91b7a] text-white font-bold rounded-md hover:bg-[#a11562] shadow-lg">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#e8675c]/30 w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2"><h3 class="text-lg font-bold text-[#e8675c]">Excluir Produto</h3><button onclick="closeDeleteModal()" class="text-gray-400 hover:text-white transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button></div>
            <p class="text-gray-300 mb-6 text-center text-sm">Tem certeza que deseja remover este produto? <span class="text-[#e8675c] font-bold block uppercase mt-1">Essa ação é irreversível.</span></p>
            <form id="deleteForm" method="POST">@csrf @method('DELETE')<div class="flex justify-center gap-4"><button type="button" onclick="closeDeleteModal()" class="px-6 py-2 text-white bg-[#482b52] rounded-md font-bold">Cancelar</button><button type="submit" class="px-6 py-2 bg-[#e8675c] text-white font-bold rounded-md hover:bg-[#c54f45]">Confirmar Exclusão</button></div></form>
        </div>
    </div>

    <script>
        const produtosData = {};
        @foreach($produtos as $produto)
            produtosData[{{ $produto->id }}] = {!! json_encode([
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $produto->quantidade,
                'descricao' => $produto->descricao,
                'categoria' => $produto->categoria,
                'data_criacao' => $produto->data_criacao,
            ]) !!};
        @endforeach

        function openCreateModal(e) { e.preventDefault(); document.getElementById('createModal').classList.remove('hidden'); }
        function closeCreateModal() { document.getElementById('createModal').classList.add('hidden'); document.getElementById('createForm').reset(); }

        function openViewModal(e, id) {
            e.preventDefault(); const data = produtosData[id]; if (!data) return;
            document.getElementById('viewNome').value = data.nome;
            document.getElementById('viewPreco').value = 'R$ ' + parseFloat(data.preco).toLocaleString('pt-br', {minimumFractionDigits: 2});
            document.getElementById('viewQuantidade').value = data.quantidade + ' un.';
            document.getElementById('viewDescricao').value = data.descricao;
            document.getElementById('viewModal').classList.remove('hidden');
        }
        function closeViewModal() { document.getElementById('viewModal').classList.add('hidden'); }

        function openEditModal(e, id) {
            e.preventDefault(); 
            const data = produtosData[id]; 
            if (!data) return;
            
            document.getElementById('editForm').action = `/produtos/${id}`;
            document.getElementById('editNome').value = data.nome;
            document.getElementById('editCategoria').value = data.categoria; 
            document.getElementById('editPreco').value = data.preco;
            document.getElementById('editQuantidade').value = data.quantidade;
            document.getElementById('editDescricao').value = data.descricao; 
            
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

        function openDeleteModal(e, id) {
            e.preventDefault(); document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = `/produtos/${id}`;
        }
        function closeDeleteModal() { document.getElementById('deleteModal').classList.add('hidden'); }

        window.onclick = function(event) {
            if (event.target === document.getElementById('createModal')) closeCreateModal();
            if (event.target === document.getElementById('viewModal')) closeViewModal();
            if (event.target === document.getElementById('editModal')) closeEditModal();
            if (event.target === document.getElementById('deleteModal')) closeDeleteModal();
        }
    </script>
</x-app-layout>