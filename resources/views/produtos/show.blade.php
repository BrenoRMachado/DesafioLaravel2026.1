<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg p-8 flex flex-col md:flex-row gap-8">
                
                <div class="w-full md:w-1/2 bg-[#482b52] rounded-xl flex items-center justify-center h-96">
                    <span class="text-white font-medium">Espaço para Imagem do Produto</span>
                </div>

                <div class="w-full md:w-1/2 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $produto->nome }}</h1>
                        
                        <p class="text-yellow-400 font-semibold mb-4">{{ ucfirst($produto->categoria) }}</p>
                        
                        <p class="text-white text-lg mb-6 leading-relaxed">
                            {{ $produto->descricao }}
                        </p>
                        
                        <p class="text-4xl font-bold text-yellow-400 mb-2">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                        
                        <p class="text-sm text-white">Vendedor: {{ $produto->vendedor->name ?? 'Desconhecido' }}</p>
                    </div>

                    <div class="mt-8">
                        @if(!auth()->user()->is_admin)
                            <button class="w-full bg-[#c91b7a] text-white font-bold py-4 rounded-lg hover:opacity-90 transition">
                                Comprar Agora
                            </button>
                        @endif
                        
                        <a href="{{ route('home') }}" class="block text-center text-white mt-4 hover:underline transition">
                            Voltar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>