<x-app-layout>

    <head>
        <!-- Adicionar o CSS do Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <!-- Adicionar o Leaflet Routing Machine -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
            {{ __('Calendário de Corridas') }}
        </h2>
    </x-slot>

    <div class="py-4">
        @if (Auth::user()->is_administrator)
            <!-- Botão Criar Nova Corrida -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <a href="{{ route('races.create') }}" style="background-color: #FF9800;"
                    class="hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow transition-all duration-300 ease-in-out">
                    Criar Nova Corrida
                </a>
            </div>
        @endif

        <!-- Exibição de Próximas Corridas -->
        <div class="container-fluid py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#0a161c] overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4" style="color: #FF9800;">Próximas Corridas</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($upcomingRaces as $race)
                                <div class="bg-[#0a161c] border-2 border-orange-500 rounded-lg p-4 shadow-lg">
                                    <h1 class="text-center text-lg font-bold mb-4" style="color: #FF9800;">Corrida:
                                        {{ $race->name }}</h1>
                                    <p style="color: #FF9800;"><strong>Categoria:</strong> {{ $race->category }}</p>
                                    <p style="color: #FF9800;"><strong>Número Máximo de Veículos:</strong>
                                        {{ $race->max_vehicles }}</p>
                                    <p style="color: #FF9800;"><strong>Data:</strong>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $race->date_time)->format('d/m/Y - H:i') }}
                                    </p>
                                    <div id="map-{{ $race->id }}" class="w-full h-48 mt-4 rounded-lg"></div>
                                    <div class="flex justify-center space-x-4 mt-4">
                                        <a href="{{ route('races.show', $race->id) }}"
                                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                            Saiba mais
                                        </a>
                                    </div>
                                </div>
                                <script>
                                    var map{{ $race->id }} = L.map('map-{{ $race->id }}').setView([-23.5505, -46.6333], 13);
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                        attribution: '© OpenStreetMap'
                                    }).addTo(map{{ $race->id }});
                                    L.Routing.control({
                                        waypoints: [
                                            L.latLng({{ $race->start_latitude }}, {{ $race->start_longitude }}),
                                            L.latLng({{ $race->end_latitude }}, {{ $race->end_longitude }})
                                        ],
                                        draggableWaypoints: false, // Desabilita a movimentação dos waypoints
                                        lineOptions: {
                                            styles: [{
                                                color: 'blue',
                                                opacity: 1,
                                                weight: 5
                                            }]
                                        }
                                    }).addTo(map{{ $race->id }});
                                </script>
                            @empty
                                <p style="color: #FF9800;">Nenhuma corrida futura disponível.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exibição de Corridas Passadas -->
        <div class="container-fluid py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#0a161c] overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4" style="color: #FF9800;">Corridas Anteriores</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($pastRaces as $race)
                                <div class="bg-[#0a161c] border-2 border-orange-500 rounded-lg p-4 shadow-lg">
                                    <h1 class="text-center text-lg font-bold mb-4" style="color: #FF9800;">Corrida:
                                        {{ $race->name }}</h1>
                                    <p style="color: #FF9800;"><strong>Categoria:</strong> {{ $race->category }}</p>
                                    <p style="color: #FF9800;"><strong>Número Máximo de Veículos:</strong>
                                        {{ $race->max_vehicles }}</p>
                                    <p style="color: #FF9800;"><strong>Data:</strong>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $race->date_time)->format('d/m/Y - H:i') }}
                                    </p>
                                    <div id="map-{{ $race->id }}" class="w-full h-48 mt-4 rounded-lg"></div>
                                    <div class="flex justify-center space-x-4 mt-4">
                                        <a href="{{ route('races.show', $race->id) }}"
                                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                            Saiba mais
                                        </a>
                                    </div>
                                </div>
                                <script>
                                    var map{{ $race->id }} = L.map('map-{{ $race->id }}').setView([-23.5505, -46.6333], 13);
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                        attribution: '© OpenStreetMap'
                                    }).addTo(map{{ $race->id }});
                                    L.Routing.control({
                                        waypoints: [
                                            L.latLng({{ $race->start_latitude }}, {{ $race->start_longitude }}),
                                            L.latLng({{ $race->end_latitude }}, {{ $race->end_longitude }})
                                        ],
                                        draggableWaypoints: false, // Desabilita a movimentação dos waypoints
                                        lineOptions: {
                                            styles: [{
                                                color: 'red',
                                                opacity: 1,
                                                weight: 5
                                            }]
                                        }
                                    }).addTo(map{{ $race->id }});
                                </script>
                            @empty
                                <p style="color: #FF9800;">Nenhuma corrida passada disponível.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
