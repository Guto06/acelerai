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
            <div>
                <label for="start_location" style="color: #FF9800;">Local de Largada:</label>
                <input type="text" name="start_location" id="start_location" value="{{ old('start_location') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="start_latitude" style="color: #FF9800;">Latitude da Largada:</label>
                <input type="text" name="start_latitude" id="start_latitude" value="{{ old('start_latitude') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="start_longitude" style="color: #FF9800;">Longitude da Largada:</label>
                <input type="text" name="start_longitude" id="start_longitude" value="{{ old('start_longitude') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
            </div>
            <div>
                <label for="end_location" style="color: #FF9800;">Local de Chegada:</label>
                <input type="text" name="end_location" id="end_location" value="{{ old('end_location') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="end_latitude" style="color: #FF9800;">Latitude da Chegada:</label>
                <input type="text" name="end_latitude" id="end_latitude" value="{{ old('end_latitude') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="end_longitude" style="color: #FF9800;">Longitude da Chegada:</label>
                <input type="text" name="end_longitude" id="end_longitude" value="{{ old('end_longitude') }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800; color: white; font-weight: bold; padding: 10px 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    {{ __('Criar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
