<x-app-layout>
    <head>
        <!-- Adicionar o CSS do Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <!-- Adicionar o Leaflet Routing Machine -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    </head>
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
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
            <a href="{{ route('races.show', $race->id) }}"
                class="flex justify-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 ease-in-out"
                style="border: 2px solid #FFFFFF;">
                Voltar
            </a>
            <h1 class="text-center text-xl font-bold text-white">Inserir Resultados para Corrida: {{ $race->name }}</h1>
            <form action="{{ route('races.enterResults', ['raceId' => $race->id, 'vehicleId' => 0]) }}" method="POST" id="resultForm">
                @csrf
                <div>
                    <label for="vehicle" class="text-white" style="color: #FF9800;">Selecione o Veículo:</label>
                    <select name="vehicleId" id="vehicle" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" onchange="updateFormAction(this)">
                        <option value="">-- Selecione o Veículo --</option>
                        @foreach ($availableVehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->user->name }}: {{ $vehicle->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="position" class="text-white" style="color: #FF9800;">Posição:</label>
                    <select name="position" id="position" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" required>
                        <option value="">-- Selecione a Posição --</option>
                        @for ($i = 1; $i <= $race->max_vehicles; $i++)
                            @if (!in_array($i, $occupiedPositions))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="time" class="text-white" style="color: #FF9800;">Tempo (hh:mm:ss):</label>
                    <input type="time" name="time" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" required step="1">
                </div>
                <div>
                    <label for="fuel_consumption" class="text-white" style="color: #FF9800;">Consumo de Combustível:</label>
                    <input type="number" name="fuel_consumption" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" step="0.1" required>
                </div>
                <div>
                    <label for="average_speed" class="text-white" style="color: #FF9800;">Velocidade Média:</label>
                    <input type="number" name="average_speed" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" step="0.1" required>
                </div>
                <div>
                    <label for="car_condition" class="text-white" style="color: #FF9800;">Estado do Carro:</label>
                    <select name="car_condition" class="block mt-1 w-full rounded-md shadow-sm" style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" required>
                        <option value="excellent">Excelente</option>
                        <option value="good">Bom</option>
                        <option value="fair">Médio</option>
                        <option value="poor">Ruim</option>
                    </select>
                </div>
                <div class="flex items-center justify-center mt-4">
                    <x-primary-button style="background-color: #FF9800;">
                        {{ __('Inserir Resultados') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function updateFormAction(select) {
            const form = document.getElementById('resultForm');
            const vehicleId = select.value;
            if (vehicleId) {
                form.action = "{{ url('races/' . $race->id . '/enter-results') }}/" + vehicleId;
            } else {
                form.action = "{{ route('races.enterResults', ['raceId' => $race->id, 'vehicleId' => 0]) }}";
            }
        }
    </script>
</x-app-layout>
