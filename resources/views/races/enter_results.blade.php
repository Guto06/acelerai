
    <h1>Inserir Resultados para Corrida: {{ $race->name }}</h1>

    <form action="{{ route('races.enterResults', ['raceId' => $race->id, 'vehicleId' => 0]) }}" method="POST" id="resultForm">
        @csrf
        <label for="vehicle">Selecione o Veículo:</label>
        <select name="vehicleId" id="vehicle" onchange="updateFormAction(this)">
            <option value="">-- Selecione o Veículo --</option>
            @foreach ($availableVehicles as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->user->name }}: {{ $vehicle->model }}</option>
            @endforeach
        </select>

        <label for="position">Posição:</label>
        <select name="position" id="position" required>
            <option value="">-- Selecione a Posição --</option>
            @for ($i = 1; $i <= 10; $i++)
                @if (!in_array($i, $occupiedPositions))
                    <option value="{{ $i }}">{{ $i }}</option>
                @endif
            @endfor
        </select>

        <label for="time">Tempo (hh:mm:ss):</label>
        <input type="time" name="time" required step="1">

        <label for="fuel_consumption">Consumo de Combustível:</label>
        <input type="number" name="fuel_consumption" step="0.1" required>

        <label for="average_speed">Velocidade Média:</label>
        <input type="number" name="average_speed" step="0.1" required>

        <label for="car_condition">Estado do Carro:</label>
        <select name="car_condition" required>
            <option value="excellent">Excelente</option>
            <option value="good">Bom</option>
            <option value="fair">Regular</option>
            <option value="poor">Ruim</option>
        </select>

        <button type="submit">Enviar Resultados</button>
    </form>

    <script>
        function updateFormAction(select) {
            const form = document.getElementById('resultForm');
            const vehicleId = select.value;
            if (vehicleId) {
                form.action = "{{ url('races/' . $race->id . '/enter-results') }}/" + vehicleId;
                console.log(vehicleId)
            } else {
                form.action = "{{ route('races.enterResults', ['raceId' => $race->id, 'vehicleId' => 0]) }}";
            }
        }
    </script>

