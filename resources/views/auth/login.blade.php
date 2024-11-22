<x-guest-layout>
    <!-- Ajusta o fundo do formulário de login -->
    <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="text-center">
            <h2 class="text-3xl font-bold" style="color: #FF9800;">Log In</h2>
            <p class="mt-2 text-sm" style="color: #FF9800;">Sign in to access your account</p>
        </div>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <div class="w-full max-w-lg mx-auto">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md animate-fade-in" role="alert">
                            <span class="block sm:inline">{{ session('msg') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.classList.add('hidden')">
                                    <title>Fechar</title>
                                    <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.935 2.935a1 1 0 01-1.414-1.414L8.586 10 5.651 7.065a1 1 0 111.414-1.414L10 8.586l2.935-2.935a1 1 0 111.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" style="color: #FF9800;" />
                <x-text-input id="email" class="block w-full mt-1 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" style="color: #FF9800;" />
                <x-text-input id="password" class="block w-full mt-1 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="w-4 h-4 text-orange-500 rounded focus:ring-orange-500 bg-gray-900" style="border: 2px solid #FF9800;">
                <label for="remember_me" class="ml-3 text-sm" style="color: #FF9800;">{{ __('Remember me') }}</label>
            </div>
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm hover:text-orange-400" href="{{ route('password.request') }}" style="color: #FF9800;">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-primary-button class="ml-3" style="background-color: #FF9800; border: 2px solid #FF9800;">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
