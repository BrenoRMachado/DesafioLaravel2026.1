<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-4xl font-black tracking-widest" style="color: #FFCA06;">
            E-COMMERCE
        </h1>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" value="E-mail" class="text-white" />
            <x-text-input id="email" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4" 
                style="background-color: white; color: #1a0a20;"
                type="email" name="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Nova Senha" class="text-white" />
            <x-text-input id="password" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4"
                style="background-color: white; color: #1a0a20;"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Nova Senha" class="text-white" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4"
                style="background-color: white; color: #1a0a20;"
                type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center py-4 border-none transition-transform hover:scale-105 active:scale-95"
                style="background-color: #C91C7A;">
                <span class="text-white font-black text-lg uppercase">REDEFINIR SENHA</span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>