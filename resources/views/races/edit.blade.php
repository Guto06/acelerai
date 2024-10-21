<x-guest-layout>
    <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
        <h1 class="text-center text-xl font-bold" style="color: #FF9800;">Editar Corrida: {{ $race->name }}</h1>
        <form action="{{ route('races.update', $race->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="name" :value="__('Nome')" style="color: #FF9800;" />
                <x-text-input id="name" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="name" value="{{ $race->name }}" required autofocus style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Categoria')" style="color: #FF9800;" />
                <x-text-input id="category" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="category" value="{{ $race->category }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="max_vehicles" :value="__('Número Máximo de Veículos')" style="color: #FF9800;" />
                <x-text-input id="max_vehicles" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="max_vehicles" value="{{ $race->max_vehicles }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('max_vehicles')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="date" :value="__('Data')" style="color: #FF9800;" />
                <x-text-input id="date" class="block mt-1 w-full rounded-md shadow-sm" type="date" name="date" value="{{ $race->date }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <div>
                <label for="start_location" style="color: #FF9800;">Local de Largada:</label>
                <input type="text" name="start_location" id="start_location" value="{{ $race->start_location }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="start_latitude" style="color: #FF9800;">Latitude da Largada:</label>
                <input type="text" name="start_latitude" id="start_latitude" value="{{ $race->start_latitude }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="start_longitude" style="color: #FF9800;">Longitude da Largada:</label>
                <input type="text" name="start_longitude" id="start_longitude" value="{{ $race->start_longitude }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
            </div>
            <div>
                <label for="end_location" style="color: #FF9800;">Local de Chegada:</label>
                <input type="text" name="end_location" id="end_location" value="{{ $race->end_location }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="end_latitude" style="color: #FF9800;">Latitude da Chegada:</label>
                <input type="text" name="end_latitude" id="end_latitude" value="{{ $race->end_latitude }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
                <label for="end_longitude" style="color: #FF9800;">Longitude da Chegada:</label>
                <input type="text" name="end_longitude" id="end_longitude" value="{{ $race->end_longitude }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onfocus="this.style.borderColor='#FF9800'; this.style.outlineColor='#FF9800';" />
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800;">
                    {{ __('Atualizar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
