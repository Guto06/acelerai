<x-guest-layout>
    <head>
        <!-- Adicionar o CSS do Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <!-- Adicionar o Leaflet Routing Machine -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    </head>
    <div class="container">
        <h1 class="text-center text-xl font-bold" style="color: black;">Corrida: {{ $race->name }}</h1>
        <p style="color: black;"><strong>ID:</strong> {{ $race->id }}</p>
        <p style="color: black;"><strong>Categoria:</strong> {{ $race->category }}</p>
        <p style="color: black;"><strong>Número Máximo de Veículos:</strong> {{ $race->max_vehicles }}</p>
        <p style="color: black;"><strong>Data:</strong> {{ $race->date }}</p>
        <div class="flex justify-center space-x-4 mt-4">
            <a href="{{ route('races.edit', $race->id) }}" class="btn btn-warning" style="background-color: #FF9800; border: 2px solid #FF9800;">Editar</a>
            <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="background-color: #FF9800; border: 2px solid #FF9800;">Excluir</button>
            </form>
            <a href="{{ route('races.index') }}" class="btn btn-secondary" style="background-color: #FF9800; border: 2px solid #FF9800;">Voltar</a>
        </div>
    </div>
    <div id="map" style="height: 400px; width: 100%;"></div>
    <script>
    // Inicializa o mapa
    var map = L.map('map').setView([-23.5505, -46.6333], 13); // Ponto inicial (São Paulo) e zoom
    // Adiciona o tile layer do OpenStreetMap ao mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Adiciona a rota usando o Leaflet Routing Machine e OSRM
    L.Routing.control({
        waypoints: [
            L.latLng({{ $race->start_latitude }}, {{ $race->start_longitude }}),
            L.latLng({{ $race->end_latitude }}, {{ $race->end_longitude }})
        ],
        router: new L.Routing.OSRMv1({
            serviceUrl: 'https://router.project-osrm.org/route/v1'
        }),
        createMarker: function(i, waypoint, n) {
            var marker = L.marker(waypoint.latLng).bindPopup(i === 0 ? 'Largada' : 'Chegada');
            return marker;
        },
        lineOptions: {
            styles: [{color: 'blue', opacity: 1, weight: 5}]
        }
    }).addTo(map);
    </script>
</x-guest-layout>
