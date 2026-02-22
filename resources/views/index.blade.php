<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Página Inicial') }}
        </h2>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background-color: #2f1c37;">
                <div class="p-6">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="flex gap-2">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="O que você está procurando?" 
                                value="{{ request('search') }}"
                                class="w-full rounded-lg border-[#482b52] bg-[#482b52] text-white focus:border-[#e7675c] focus:ring-[#e7675c] placeholder-gray-300 focus:placeholder-transparent transition-all duration-300 pl-6"
                            >
                            <button type="submit" class="px-8 py-2 rounded-lg text-white font-bold transition hover:opacity-90" style="background-color: #e7675c;">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #2f1c37;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Confira nossas ofertas!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($produtos as $produto)
                            <div class="border border-[#482b52] p-4 rounded-lg flex flex-col justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">{{ $produto->nome }}</h4>
                                    
                                    <p class="text-white text-sm mb-2">{{ Str::limit($produto->descricao, 50) }}</p>
                                    
                                    <p class="font-bold text-xl" style="color: #ffcb06;">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <a href="#" class="inline-block text-white px-4 py-2 rounded text-sm transition hover:opacity-90" 
                                    style="background-color: #c91b7a;">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pb-1 flex justify-center pagination-custom">
                        {{ $produtos->links() }}
                    </div>
                        <style>
                            .pagination-custom nav div:first-child {
                                display: none !important;
                            }

                            .pagination-custom nav div:last-child {
                                display: flex !important;
                                justify-content: center !important;
                                width: 100% !important;
                            }

                            .pagination-custom span, .pagination-custom a {
                                background-color: #472652 !important; 
                                border-color: #4c2e57 !important; 
                                color: white !important;
                            }

                            .pagination-custom span[aria-current="page"] span {
                                background-color: #e7675c !important;
                                color: white !important;
                                border-color: #e7675c !important;
                            }

                            .pagination-custom a:hover {
                                background-color: #4c2e57 !important;
                            }
                        </style>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>