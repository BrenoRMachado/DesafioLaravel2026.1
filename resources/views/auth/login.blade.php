<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-4xl font-black tracking-widest" style="color: #FFCA06;">
            E-COMMERCE
        </h1>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="E-mail" class="text-white" />
            <x-text-input id="email" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4" 
                style="background-color: white; color: #1a0a20;"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Senha" class="text-white" />
            <x-text-input id="password" 
                class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4"
                style="background-color: white; color: #1a0a20;"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-none text-[#C91C7A] focus:ring-[#C91C7A]" style="background-color: white;" name="remember">
                <span class="ms-2 text-sm text-gray-300">Lembrar de mim</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center py-4 border-none transition-transform hover:scale-105 active:scale-95"
                style="background-color: #C91C7A;">
                <span class="text-white font-black text-lg">ENTRAR</span>
            </x-primary-button>

            <div class="flex items-center justify-between mt-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm font-bold text-[#C91C7A] hover:text-[#E8675C] transition-colors duration-300" 
                       href="{{ route('password.request') }}">
                        Esqueceu sua senha?
                    </a>
                @endif
                
                <a class="underline text-sm font-bold text-[#C91C7A] hover:text-[#E8675C] transition-colors duration-300" 
                   href="{{ route('register') }}">
                    Não possui uma conta?
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>