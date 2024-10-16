<x-guest-layout>
    <!-- Ajusta o fundo do formulário de registro -->
    <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
        <form method="POST" action="/veiculos/update/{{ $vehicle->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="model" :value="__('Modelo')" style="color: #FF9800;" />
                <x-text-input id="model" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="model" value="{{ $vehicle->model }}" required autofocus autocomplete="model" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('model')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="brand" :value="__('Marca')" style="color: #FF9800;" />
                <x-text-input id="brand" class="block mt-1 w-full rounded-md shadow-sm" type="brand" name="brand" value="{{ $vehicle->brand }}" required autocomplete="username" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="year" :value="__('Ano')" style="color: #FF9800;" />
                <x-text-input id="year" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="year" value="{{ $vehicle->year }}" required autocomplete="year" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('year')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="power" :value="__('Potência')" style="color: #FF9800;" />
                <x-text-input id="power" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="power" value="{{ $vehicle->power }}" required autocomplete="power" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('power')" class="mt-2" />
            </div>



            <div class="flex items-center justify-center mt-4">

                <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800;">
                    {{ __('Editar Veículo') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
