<x-app-layout>
    <head>
        <!-- Adicionar o CSS do Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <!-- Adicionar o Leaflet Routing Machine -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    </head>
    <div class="flex items-center justify-center min-h-screen mt-12">
        <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
            <h1 class="text-center text-xl font-bold text-white">Criar Corrida</h1>
            <form action="{{ route('races.store') }}" method="POST">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nome')" style="color: #FF9800;" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="name" required autofocus style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" :value="__('Categoria')" style="color: #FF9800;" />
                    <x-text-input id="category" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="category" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="max_vehicles" :value="__('Número Máximo de Veículos')" style="color: #FF9800;" />
                    <x-text-input id="max_vehicles" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="max_vehicles" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('max_vehicles')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="date" :value="__('Data')" style="color: #FF9800;" />
                    <x-text-input id="date" class="block mt-1 w-full rounded-md shadow-sm" type="date" name="date" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <!-- Mapa para selecionar local de largada e chegada -->
                <div id="map" class="mt-4" style="height: 400px; width: 100%;"></div>

                <!-- Inputs escondidos para armazenar as coordenadas -->
                <input type="hidden" name="start_latitude" id="start_latitude" />
                <input type="hidden" name="start_longitude" id="start_longitude" />
                <input type="hidden" name="end_latitude" id="end_latitude" />
                <input type="hidden" name="end_longitude" id="end_longitude" />

                <!-- Botão para criar a corrida -->
                <div class="flex items-center justify-center mt-4">
                    <x-primary-button style="background-color: #FF9800;">
                        {{ __('Criar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para inicializar o mapa e capturar pontos -->
    <script>
        // Inicializar o mapa no OpenStreetMap
        var map = L.map('map').setView([-22.909938, -47.062633], 13); // Coordenadas padrão (Campinas)

        // Adicionar a camada do OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        var startMarker, endMarker, routeControl;

        // Função para adicionar rota no mapa
        function showRoute(startLat, startLng, endLat, endLng) {
            if (routeControl) {
                map.removeControl(routeControl);  // Remove rota anterior, se existir
            }
            routeControl = L.Routing.control({
                waypoints: [
                    L.latLng(startLat, startLng),
                    L.latLng(endLat, endLng)
                ],
                routeWhileDragging: true
            }).addTo(map);
        }

        // Função para selecionar o ponto de largada e permitir arrastar
        map.on('click', function(e) {
            if (!startMarker) {
                startMarker = L.marker(e.latlng, {draggable: true}).addTo(map)
                    .bindPopup("Largada")
                    .openPopup();
                document.getElementById('start_latitude').value = e.latlng.lat;
                document.getElementById('start_longitude').value = e.latlng.lng;

                // Atualizar coordenadas ao arrastar
                startMarker.on('dragend', function(event) {
                    var position = event.target.getLatLng();
                    document.getElementById('start_latitude').value = position.lat;
                    document.getElementById('start_longitude').value = position.lng;

                    // Atualizar rota, se o ponto de chegada já estiver definido
                    if (endMarker) {
                        showRoute(position.lat, position.lng, endMarker.getLatLng().lat, endMarker.getLatLng().lng);
                    }
                });
            } else if (!endMarker) {
                endMarker = L.marker(e.latlng, {draggable: true}).addTo(map)
                    .bindPopup("Chegada")
                    .openPopup();
                document.getElementById('end_latitude').value = e.latlng.lat;
                document.getElementById('end_longitude').value = e.latlng.lng;

                // Atualizar coordenadas ao arrastar
                endMarker.on('dragend', function(event) {
                    var position = event.target.getLatLng();
                    document.getElementById('end_latitude').value = position.lat;
                    document.getElementById('end_longitude').value = position.lng;

                    // Atualizar rota
                    showRoute(startMarker.getLatLng().lat, startMarker.getLatLng().lng, position.lat, position.lng);
                });

                // Mostrar rota entre os pontos
                showRoute(startMarker.getLatLng().lat, startMarker.getLatLng().lng, e.latlng.lat, e.latlng.lng);
            }
        });
    </script>
</x-app-layout>
