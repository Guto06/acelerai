<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Editar Informações do Piloto</h1>
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
