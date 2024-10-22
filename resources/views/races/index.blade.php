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
            {{ __('Corridas Disponíveis') }}
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
    <div class="py-12">

        @if (Auth::user()->is_administrator)
        <!-- Botão Criar Nova Corrida -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('races.create') }}" style="background-color: #FF9800;" class="hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow transition-all duration-300 ease-in-out">
                Criar Nova Corrida
            </a>
        </div>
        @endif

    <div class="container-fluid py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a161c] overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                <div class="p-6">
                    <!-- Grid para exibir cards de corridas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($races as $race)
                        <div class="bg-[#0a161c] border-2 border-orange-500 rounded-lg p-4 shadow-lg">
                            <h1 class="text-center text-lg font-bold" style="color: #FF9800;">Corrida: {{ $race->name }}</h1>
                            <p style="color: #FF9800;"><strong>ID:</strong> {{ $race->id }}</p>
                            <p style="color: #FF9800;"><strong>Categoria:</strong> {{ $race->category }}</p>
                            <p style="color: #FF9800;"><strong>Número Máximo de Veículos:</strong> {{ $race->max_vehicles }}</p>
                            <p style="color: #FF9800;"><strong>Data:</strong> {{ $race->date }}</p>

                            <!-- Mapa da corrida -->
                            <div id="map-{{ $race->id }}" class="w-full h-48 mt-4 rounded-lg"></div>

                            @if (Auth::user()->is_administrator)
                            <!-- Botões redondos e espaçados -->
                            <div class="flex justify-center space-x-4 mt-4">
                                <a href="{{ route('races.edit', $race->id) }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                    Editar
                                </a>
                                <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                            @endif
                            @if (!Auth::user()->is_administrator)
                            <!-- Botão Participar da corrida / tem que implementar-->
                            <div class="flex justify-center space-x-4 mt-4">
                                <a href="{{ route('dashboard.user', $race->id) }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                    Participar da corrida
                                </a>
                                
                            </div>
                            @endif
                        </div>

                        <!-- Script para inicializar o mapa com coordenadas específicas de cada corrida -->
                        <script>
                            var map{{ $race->id }} = L.map('map-{{ $race->id }}').setView([-23.5505, -46.6333], 13); // inicializando o mapa em sao pa
                            
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '© OpenStreetMap'
                            }).addTo(map{{ $race->id }});
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
                                    styles: [{ color: 'blue', opacity: 1, weight: 5 }]
                                }
                            }).addTo(map{{ $race->id }});  // <-- Use map{{ $race->id }} aqui

                        </script>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
