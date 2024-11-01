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
            @if (session('msg') || session('error'))
                <div class="w-full max-w-lg mx-auto">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md animate-fade-in"
                        role="alert">
                        <span class="block sm:inline">{{ session('msg') }}</span>
                        <span class="block sm:inline text-red-500">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                onclick="this.parentElement.parentElement.classList.add('hidden')">
                                <title>Fechar</title>
                                <path
                                    d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.935 2.935a1 1 0 01-1.414-1.414L8.586 10 5.651 7.065a1 1 0 111.414-1.414L10 8.586l2.935-2.935a1 1 0 111.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z" />
                            </svg>
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if (!Auth::user())
        <nav class="navbar flex justify-between items-center p-6 bg-gray-900 shadow-lg">
            <div class="text-2xl font-semibold">
                <a href="/">
                    <img src="{{ asset('imagens/acelerai.png') }}" alt="Logo" class="w-32 h-32 ml-12" />
                </a>
            </div>
            @if (Route::has('login'))
                <div class="space-x-4 font-semibold mr-11">
                    @auth
                        <a href="{{ Auth::user()->is_administrator ? url('/dashboard') : url('/dashboard/user') }}"
                            class="text-white hover:text-yellow-500 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-500 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-white hover:text-yellow-500 transition">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
    @endif
    <div class="container mx-auto py-20 w-auto h-auto">
        <div class="bg-gray-800 p-10 rounded-lg shadow-xl max-w-4xl mx-auto" style="border: 3px solid #FF9800;">
            <div class="mt-2">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">{{ $race->name }}</h1>
                    <p style="color: #FFFFFF;"><strong>Categoria:</strong> {{ $race->category }}</p>
                    <p style="color: #FFFFFF;"><strong>Data:</strong>
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $race->date_time)->format('d/m/Y - H:i') }}
                    </p>
                    <p style="color: #FFFFFF;"><strong>Máx. de Veículos:</strong> {{ $race->max_vehicles }}</p>

                    <!-- Botões redondos e espaçados -->
                    <div class="flex justify-center space-x-4 mt-4 mb-8">
                        @if (Auth::user()->is_administrator)
                            @if (now()->greaterThanOrEqualTo($race->date_time))
                                <a href="{{ route('races.enterResultsForm', $race->id) }}"
                                    class="bg-green-500 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 ease-in-out"
                                    style="border: 2px solid #FFFFFF;">
                                    Inserir Resultados
                                </a>
                            @endif
                            <a href="{{ route('races.edit', $race->id) }}"
                                class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 ease-in-out"
                                style="border: 2px solid #FFFFFF;">
                                Editar
                            </a>
                            <form action="{{ route('races.destroy', $race->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                    Excluir
                                </button>
                            </form>

                            <a href="{{ route('races.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                Voltar
                            </a>
                        @endif
                        @if (
                            !Auth::user()->is_administrator &&
                                Auth::user()->vehicles->isNotEmpty() &&
                                !$race->vehicles()->whereIn('vehicle_id', Auth::user()->vehicles->pluck('id'))->exists() &&
                                now()->lessThan($race->date_time))
                            <button id="participateButton" onclick="showModal()"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Participar da Corrida
                            </button>
                        @endif
                    </div>

                    <!-- Modal -->
                    <div id="vehicleModal" class="fixed z-50 inset-0 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                            <button id="closeModal"
                                class="absolute top-0 right-0 m-2 text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div id="vehicle-list" class="mt-4">
                                <!-- Conteúdo do modal será preenchido dinamicamente -->
                            </div>
                        </div>
                    </div>

                    <!-- Fundo escurecido -->
                    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>
                </div>

                <!-- Espaço entre botões e mapa -->
                <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg"
                            style="border: 5px solid #FF9800;">
                            @if ($race->vehicles->isNotEmpty())
                                <div class="mt-6 ml-4">
                                    <h2 class="text-xl font-bold mb-4">Pilotos Inscritos:
                                        {{ $race->vehicles()->count() }}</h2>
                                    <ul class="space-y-4 border p-4 rounded-lg mb-4">
                                        @foreach ($race->vehicles as $vehicle)
                                            <div
                                                class="flex justify-between items-center mb-4 border-b pb-4 border-black">
                                                <li>
                                                    <p><strong>Piloto:</strong> {{ $vehicle->user->name }}</p>
                                                    <p><strong>Carro:</strong> {{ $vehicle->brand }}
                                                        {{ $vehicle->model }}</p>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="mt-4 mb-4 ml-2">Nenhum participante inscrito até o momento.</p>
                            @endif

                        </div>
                    </div>
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
                                styles: [{
                                    color: 'blue',
                                    opacity: 1,
                                    weight: 5
                                }]
                            }
                        }).addTo(map);
                    </script>

                    <script>
                        // Funções de controle do modal
                        function showModal() {
                            document.getElementById('vehicleModal').classList.remove('hidden');
                            document.getElementById('modalBackdrop').classList.remove('hidden');
                            document.body.classList.add('modal-open');
                        }

                        function closeModal() {
                            document.getElementById('vehicleModal').classList.add('hidden');
                            document.getElementById('modalBackdrop').classList.add('hidden');
                            document.body.classList.remove('modal-open');
                        }

                        document.getElementById('participateButton').addEventListener('click', function() {
                            fetch(`/races/{{ $race->id }}/eligible-vehicles`, {
                                    method: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    let vehicleList = document.getElementById('vehicle-list');
                                    vehicleList.innerHTML = ''; // Limpa a lista de veículos

                                    if (data.vehicles.length > 0) {
                                        // Exibe os veículos caso existam
                                        data.vehicles.forEach(vehicle => {
                                            vehicleList.innerHTML += `
                    <form action="{{ route('races.participate', $race->id) }}" method="POST">
                        @csrf
                        <div class="border p-4 mb-2 rounded-lg">
                            <input type="hidden" name="vehicle_id" value="${vehicle.id}">
                            <p><strong>Nome:</strong> ${vehicle.brand} ${vehicle.model}</p>
                            <p><strong>Categoria:</strong> ${vehicle.category}</p></br>
                            <x-primary-button style="background-color: #FF9800;">
                                {{ __('Participar com esse veículo') }}
                            </x-primary-button>
                        </div>
                    </form>
                    `;
                                        });
                                        showModal();
                                    } else {
                                        // Exibe a mensagem caso não haja veículos na categoria
                                        vehicleList.innerHTML += `
                        <p class="text-center mt-4 mb-4 text-red-500 font-bold">Nenhum veículo nesta categoria!</p>
                `;
                                        showModal();
                                    }
                                })
                                .catch(error => {
                                    console.error('Erro ao buscar veículos:', error);
                                });
                        });


                        document.getElementById('closeModal').addEventListener('click', closeModal);
                    </script>

                    <style>
                        #map {
                            z-index: 0;
                        }

                        /* Quando o modal estiver aberto, o mapa será escondido abaixo do backdrop */
                        .modal-open #map {
                            z-index: -1;
                            /* Esconde o mapa atrás do backdrop */
                        }

                        #modalBackdrop {
                            z-index: 50;
                            /* Certifique-se de que o backdrop tenha um valor maior que o mapa */
                        }

                        #vehicleModal {
                            z-index: 60;
                            /* O modal em si deve ficar acima de tudo */
                        }
                    </style>
                </div>
            </div>
        </div>
</x-app-layout>
