<x-guest-layout>
    <!-- Ajusta o fundo do formulário de registro -->
    <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" style="color: #FF9800;" />
                <x-text-input id="name" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="username" :value="__('Username')" style="color: #FF9800;" />
                <x-text-input id="username" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" style="color: #FF9800;" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="number" :value="__('Celular')" style="color: #FF9800;" />
                <x-text-input id="number" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="number" :value="old('number')" required autocomplete="number" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('number')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="birthdate" :value="__('Data de Nascimento')" style="color: #FF9800;" />
                <x-text-input id="birthdate" class="block mt-1 w-full rounded-md shadow-sm" type="date" name="birthdate" :value="old('birthdate')" required autocomplete="birthdate" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" style="color: #FF9800;" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: #FF9800;" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="mt-4">
                <label for="license_pdf" class="block font-medium text-sm" style="color: #FF9800;">Carteira de Motorista (PDF)</label>
                <input id="license_pdf" type="file" name="license_pdf" accept="application/pdf" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;">
                @error('license_pdf')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm hover:text-orange-400" href="{{ route('login') }}" style="color: #FF9800;">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
