<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-4xl font-black tracking-widest" style="color: #FFCA06;">
            E-COMMERCE
        </h1>
    </div>

    <div class="mb-4 text-sm font-medium text-center" style="color: #FFCA06;">
        Esta é uma área segura do sistema. Por favor, confirme sua senha antes de continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" value="Senha" class="text-white" />
            <x-text-input id="password" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4"
                style="background-color: white; color: #1a0a20;"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center py-4 border-none transition-transform hover:scale-105 active:scale-95"
                style="background-color: #C91C7A;">
                <span class="text-white font-black text-lg uppercase">CONFIRMAR</span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>