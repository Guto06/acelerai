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
            {{ __('Histórico de Corridas') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-12 w-auto h-auto">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-5xl mx-auto" style="border: 3px solid #FF9800;">
            <div class="mt-2">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">Histórico de Corridas</h1>
                    <form method="GET" action="{{ route('race-history') }}" class="mb-8">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <label for="start_date" class="text-white">Data de Início</label>
                                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                                    class="rounded-md shadow-sm">
                            </div>
                            <div class="flex flex-col">
                                <label for="end_date" class="text-white">Data de Fim</label>
                                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                                    class="rounded-md shadow-sm">
                            </div>
                            <div class="flex flex-col">
                                <label for="category" class="text-white">Categoria</label>
                                <select id="category" name="category" class="rounded-md shadow-sm">
                                    <option value="">Todas</option>
                                    <option value="A" {{ $category == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $category == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ $category == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ $category == 'D' ? 'selected' : '' }}>D</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($raceHistory as $raceVehicle)
                            <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                                <h2 class="text-xl font-bold mb-2" style="color: #FF9800;">
                                    {{ $raceVehicle->race->name }}</h2>
                                <p class="text-white"><strong>Data:</strong>
                                    {{ \Carbon\Carbon::parse($raceVehicle->race->date_time)->format('d/m/Y') }}</p>
                                <p class="text-white"><strong>Categoria:</strong> {{ $raceVehicle->vehicle->category }}
                                </p>
                                <p class="text-white"><strong>Posição:</strong>
                                    @if ($raceVehicle->position)
                                        {{ $raceVehicle->position }}
                                    @else
                                        Indisponível
                                    @endif
                                </p>
                                <p class="text-white"><strong>Pontuação:</strong>
                                    @if ($raceVehicle->points)
                                        {{ $raceVehicle->points }}
                                    @else
                                        Indisponível
                                    @endif
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('races.show', $raceVehicle->race->id) }}"
                                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                        Saiba Mais
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
