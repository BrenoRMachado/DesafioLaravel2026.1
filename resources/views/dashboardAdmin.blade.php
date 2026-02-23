<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Painel Administrativo 🔐</h1>
                <p class="text-gray-400">Acesse as ferramentas de administração</p>
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
                        <p class="text-gray-400 text-sm mt-2">Gerenciar catálogo de produtos</p>
                    </div>
                </a>

                <!-- Card Usuários -->
                <a href="{{ route('users') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#ffca06] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M21 7a3 3 0 11-6 0 3 3 0 016 0zM3 20h5v-2a3 3 0 00-5.856-1.487M7 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Usuários</h3>
                        <p class="text-gray-400 text-sm mt-2">Gerenciar usuários do sistema</p>
                    </div>
                </a>

                <!-- Card Administradores -->
                <a href="{{ route('admins') }}" class="group">
                    <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52] p-6 hover:border-[#c91b7a] transition duration-300 h-full">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[#482b52] flex items-center justify-center group-hover:bg-[#c91b7a] transition">
                                <svg class="w-6 h-6 text-[#e8675c] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white group-hover:text-[#c91b7a] transition">Administradores</h3>
                        <p class="text-gray-400 text-sm mt-2">Gerenciar admins do sistema</p>
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
