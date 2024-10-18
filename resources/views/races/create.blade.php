<x-guest-layout>
    <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
        <h1 class="text-center text-xl font-bold text-white">Criar Corrida</h1>
        <form action="{{ route('races.store') }}" method="POST">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Nome')" style="color: #FF9800;" />
                <x-text-input id="name" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="name" required autofocus style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Categoria')" style="color: #FF9800;" />
                <x-text-input id="category" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="category" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="max_vehicles" :value="__('Número Máximo de Veículos')" style="color: #FF9800;" />
                <x-text-input id="max_vehicles" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="max_vehicles" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('max_vehicles')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="date" :value="__('Data')" style="color: #FF9800;" />
                <x-text-input id="date" class="block mt-1 w-full rounded-md shadow-sm" type="date" name="date" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800;">
                    {{ __('Criar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>