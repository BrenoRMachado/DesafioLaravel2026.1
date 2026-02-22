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
                        <div class="flex flex-col md:flex-row gap-3 items-stretch">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="O que você está procurando?" 
                                value="{{ request('search') }}"
                                class="flex-grow h-11 rounded-lg border-[#482b52] bg-[#482b52] text-white focus:border-[#e7675c] focus:ring-[#e7675c] placeholder-gray-300 focus:placeholder-transparent transition-all duration-300 pl-6"
                            >
                            <select 
                                name="categoria" 
                                class="w-full md:w-auto h-11 rounded-lg border-[#482b52] bg-[#482b52] text-white focus:border-[#e7675c] focus:ring-[#e7675c] cursor-pointer"
                            >
                                <option value="">Todas as Categorias</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="w-full md:w-auto h-11 px-8 rounded-lg text-white font-bold transition hover:opacity-90 flex items-center justify-center" style="background-color: #e7675c;">
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
                                    
                                    <p class="text-white text-sm mb-2 truncate" title="{{ $produto->descricao }}">
                                        {{ $produto->descricao }}
                                    </p>
                                    
                                    <p class="font-bold text-xl" style="color: #ffcb06;">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('produtos.show', $produto->id) }}" class="flex-1 text-center text-white px-4 py-2 rounded text-sm font-bold transition hover:opacity-90" 
                                    style="background-color: #68097d;">
                                        Ver Detalhes
                                    </a>

                                    @auth
                                        @if(!auth()->user()->is_admin) 
                                            <button class="flex-1 text-white px-4 py-2 rounded text-sm font-bold transition hover:opacity-90" 
                                                    style="background-color: #c91b7a;">
                                                Comprar
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pb-1 flex justify-center pagination-custom">
                        {{ $produtos->links() }}
                    </div>
                        <style>
                            .pagination-custom nav div:first-child {
                                display: none;
                            }

                            .pagination-custom nav div:last-child {
                                display: flex;
                                justify-content: center;
                                width: 100%;
                            }

                            .pagination-custom span, .pagination-custom a {
                                background-color: #472652; 
                                border-color: #4c2e57; 
                                color: white;
                            }

                            .pagination-custom span[aria-current="page"] span {
                                background-color: #e7675c;
                                color: white;
                                border-color: #e7675c;
                            }

                            .pagination-custom a:hover {
                                background-color: #4c2e57;
                            }
                        </style>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>