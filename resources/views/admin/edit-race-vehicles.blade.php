<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
            Editar Resultado de {{ $raceVehicle->vehicle->user->name }} na corrida {{ $raceVehicle->race->name }}!
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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
    <div class="container mx-auto px-4">
        <form action="{{ route('admin.race-vehicles.update', [$raceVehicle->race_id, $raceVehicle->vehicle_id]) }}"
            method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="position" class="block text-gray-700">Posição</label>
                <input type="number" name="position" class="form-input mt-1 block w-full"
                    value="{{ $raceVehicle->position }}" required>
            </div>
            <div class="mb-4">
                <label for="time" class="block text-gray-700">Tempo</label>
                <input type="text" name="time" class="form-input mt-1 block w-full"
                    value="{{ $raceVehicle->time }}" required>
            </div>
            <div class="mb-4">
                <label for="fuel_consumption" class="block text-gray-700">Consumo de Combustível</label>
                <input type="text" name="fuel_consumption" class="form-input mt-1 block w-full"
                    value="{{ $raceVehicle->fuel_consumption }}" required>
            </div>
            <div class="mb-4">
                <label for="average_speed" class="block text-gray-700">Velocidade Média</label>
                <input type="text" name="average_speed" class="form-input mt-1 block w-full"
                    value="{{ $raceVehicle->average_speed }}" required>
            </div>
            <div class="mb-4">
                <label for="car_condition" class="block text-gray-700">Condição do Carro (excellent, good, fair, poor)</label>
                <input type="text" name="car_condition" class="form-input mt-1 block w-full"
                    value="{{ $raceVehicle->car_condition }}" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
</x-app-layout>
