<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Minhas Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Histórico de Compras</h1>
            </div>
            <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52]">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($compras->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-400 text-lg">Você ainda não realizou nenhuma compra.</p>
                        </div>
                    @else
                        <table class="min-w-full border-none">
                            <thead class="bg-[#482b52]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Produto</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Vendedor</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Quantidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Preço Unitário</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Data</th>
                                </tr>
                            </thead>
                            <tbody class="bg-[#2f1c37] divide-y divide-[#482b52]">
                                @foreach($compras as $compra)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $compra->produto->nome }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $compra->produto->vendedor->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $compra->quantidade }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-white">R$ {{ number_format($compra->preco, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap font-mono text-yellow-400">R$ {{ number_format($compra->quantidade * $compra->preco, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="orderViewModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-6 border border-[#482b52] w-11/12 md:w-1/2 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Detalhes da Compra</h3>
                <button onclick="closeOrderViewModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Produto</label>
                    <input type="text" id="orderProduto" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Vendedor</label>
                    <input type="text" id="orderVendedor" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Quantidade</label>
                    <input type="number" id="orderQuantidade" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Preço Unitário</label>
                    <input type="text" id="orderPreco" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed font-mono text-yellow-400">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Total</label>
                    <input type="text" id="orderTotal" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed font-mono text-yellow-400">
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Data</label>
                    <input type="text" id="orderData" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Descrição do Produto</label>
                    <textarea id="orderDescricao" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed" rows="3"></textarea>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeOrderViewModal()" class="px-6 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition font-bold">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        const ordersData = {};
        @foreach($compras as $compra)
            ordersData[{{ $compra->id }}] = {
                produto: "{{ $compra->produto->nome }}",
                vendedor: "{{ $compra->produto->vendedor->name }}",
                quantidade: {{ $compra->quantidade }},
                preco: {{ $compra->preco }},
                total: {{ $compra->quantidade * $compra->preco }},
                data: "{{ $compra->created_at->format('d/m/Y H:i') }}",
                descricao: "{{ $compra->produto->descricao ?? '' }}"
            };
        @endforeach

        function openOrderViewModal(e, orderId) {
            e.preventDefault();
            const data = ordersData[orderId];
            if (!data) return;

            document.getElementById('orderProduto').value = data.produto;
            document.getElementById('orderVendedor').value = data.vendedor;
            document.getElementById('orderQuantidade').value = data.quantidade;
            document.getElementById('orderPreco').value = 'R$ ' + data.preco.toFixed(2).replace('.', ',');
            document.getElementById('orderTotal').value = 'R$ ' + data.total.toFixed(2).replace('.', ',');
            document.getElementById('orderData').value = data.data;
            document.getElementById('orderDescricao').value = data.descricao;

            document.getElementById('orderViewModal').classList.remove('hidden');
        }

        function closeOrderViewModal() {
            document.getElementById('orderViewModal').classList.add('hidden');
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('orderViewModal')) closeOrderViewModal();
        }
    </script>
</x-app-layout>
