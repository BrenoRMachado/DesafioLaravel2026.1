<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-4xl font-black tracking-widest" style="color: #FFCA06;">
            E-COMMERCE
        </h1>
        <p class="text-xl font-bold uppercase tracking-wide mt-1" style="color: #E8675C;">
            Recupere sua senha
        </p>
    </div>

    <div class="mb-4 text-sm font-medium text-center" style="color: #FFCA06;">
        Esqueceu sua senha? Sem problemas. Informe seu e-mail e enviaremos um link para você escolher uma nova.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" value="E-mail" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full border-none focus:ring-2 focus:ring-[#C91C7A] px-4" 
                style="background-color: white; color: #1a0a20;"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center py-4 border-none transition-transform hover:scale-105 active:scale-95"
                style="background-color: #C91C7A;">
                <span class="text-white font-black text-lg uppercase">ENVIAR LINK</span>
            </x-primary-button>

            <div class="text-center mt-2">
                <a class="underline text-sm font-bold text-[#C91C7A] hover:text-[#E8675C] transition-colors duration-300" 
                   href="{{ route('login') }}">
                    Voltar para o Login
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>