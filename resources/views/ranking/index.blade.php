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
            {{ __('Ranking') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- Exibição de Categorias -->
        <div class="container-fluid py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#0a161c] overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4" style="color: #FF9800;">Ranking Disponíveis</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach (['A', 'B', 'C', 'D'] as $category)
                                <div class="bg-[#0a161c] border-2 border-orange-500 rounded-lg p-4 shadow-lg">
                                    <h1 class="text-center text-lg font-bold mb-4" style="color: #FF9800;">Categoria:
                                        {{ $category }}</h1>
                                    <p style="color: #FF9800;"><strong>Descrição:</strong> Categoria {{ $category }}
                                        de veículos.</p>
                                    @if ($category == 'D')
                                        <p style="color: #FF9800;">Potência: 0-129 HP</p>
                                    @elseif ($category == 'C')
                                        <p style="color: #FF9800;">Potência: 130-189 HP</p>
                                    @elseif ($category == 'B')
                                        <p style="color: #FF9800;">Potência: 190-269 HP</p>
                                    @elseif ($category == 'A')
                                        <p style="color: #FF9800;">Potência: 270+ HP</p>
                                    @endif
                                    <div
                                        class="w-full h-48 mt-4 rounded-lg bg-gray-700 flex items-center justify-center">
                                        <img src="/imagens/categoria-{{ strtolower($category) }}.jpg"
                                            alt="Categoria {{ $category }}"
                                            class="w-full h-full object-cover rounded-lg">
                                    </div>
                                    <div class="flex justify-center space-x-4 mt-4">
                                        <a href="{{ route('ranking.show', $category) }}"
                                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                            Ver Ranking
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
