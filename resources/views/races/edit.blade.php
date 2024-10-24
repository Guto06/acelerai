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
    <div class="flex items-center justify-center min-h-screen mt-12">
        <div class="w-full max-w-md p-6 space-y-6 bg-gray-900 rounded-lg shadow-lg" style="border: 2px solid #FF9800;">
            <h1 class="text-center text-xl font-bold text-white">Editar a corrida: {{ $race->name }}</h1>
            <form action="{{ route('races.store') }}" method="POST">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nome')" style="color: #FF9800;" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-md shadow-sm" type="text" name="name" value='{{ $race->name }}' required autofocus style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" :value="__('Categoria')" style="color: #FF9800;" />
                    
                    <select id="category" name="category" class="block mt-1 w-full rounded-md shadow-sm" value="{{ $race->category }}" required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;">
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                
                <div>
                    <x-input-label for="max_vehicles" :value="__('Número Máximo de Veículos(max: 10)')" style="color: #FF9800;" />
                    <x-text-input id="max_vehicles" class="block mt-1 w-full rounded-md shadow-sm" type="number" name="max_vehicles" value='{{ $race->max_vehicles }}' required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('max_vehicles')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="date" :value="__('Data e Hora')" style="color: #FF9800;" />
                    <x-text-input id="date" class="block mt-1 w-full rounded-md shadow-sm" type="datetime-local" name="date_time" value='{{ $race->date_time }}' required style="border: 2px solid #FF9800; background-color: #2d3748; color: white;" />
                    <x-input-error :messages="$errors->get('date_time')" class="mt-2" />
                </div>

                <!-- Mapa para selecionar local de largada e chegada -->
                <div id="map" class="mt-4" style="height: 400px; width: 100%;"></div>

                <!-- Inputs escondidos para armazenar as coordenadas -->
                <input type="hidden" name="start_latitude" id="start_latitude" />
                <input type="hidden" name="start_longitude" id="start_longitude" />
                <input type="hidden" name="end_latitude" id="end_latitude" />
                <input type="hidden" name="end_longitude" id="end_longitude" />

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4" style="background-color: #FF9800; border: 2px solid #FF9800;">
                        {{ __('Atualizar') }}
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
