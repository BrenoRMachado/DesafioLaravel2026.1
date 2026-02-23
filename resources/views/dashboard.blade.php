<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Bem-vindo! 👋</h1>
                <p class="text-gray-400">Acesse as principais funcionalidades abaixo</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card Produtos -->
                <a href="{{ route('home') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#c91b7a] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V11a2 2 0 012-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Produtos</h3>
                        <p class="text-gray-400 text-sm mt-2">Confira e compre nossos produtos</p>
                    </div>
                </a>

                <!-- Card Minhas Compras -->
                <a href="{{ route('orders.compras') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#ffca06] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V11a2 2 0 012-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Minhas Compras</h3>
                        <p class="text-gray-400 text-sm mt-2">Histórico de compras realizadas</p>
                    </div>
                </a>

                <!-- Card Minhas Vendas -->
                <a href="{{ route('orders.vendas') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#e8675c] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Minhas Vendas</h3>
                        <p class="text-gray-400 text-sm mt-2">Acompanhe suas vendas</p>
                    </div>
                </a>

                <!-- Card Perfil -->
                <a href="{{ route('profile.edit') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#c91b7a] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Perfil</h3>
                        <p class="text-gray-400 text-sm mt-2">Gerencie seus dados</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
