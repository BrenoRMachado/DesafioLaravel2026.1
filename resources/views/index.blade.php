<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Página Inicial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Confira nossas ofertas!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($produtos as $produto)
                            <div class="border border-gray-200 dark:border-gray-700 p-4 rounded-lg flex flex-col justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold">{{ $produto->nome }}</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ Str::limit($produto->descricao, 50) }}</p>
                                    <p class="text-green-600 font-bold text-xl">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                </div>
            
                                <div class="mt-4">
                                    <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>