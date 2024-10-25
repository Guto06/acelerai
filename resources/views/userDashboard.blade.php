<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
        {{ __('Painel de Veículos') }}
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/veiculos/novo " class="bg-green-500  text-white font-bold py-2 px-4 rounded" >
                Adicionar Veículo
            </a>
            <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg p-6 mt-4"style="border: 5px solid #FF9800;" >
                @if (count($vehicles) > 0)
                    @foreach ($vehicles as $vehicle)
                        <div class="flex justify-between items-center border-b border-black py-4">
                            <span>{{ $vehicle->brand  }} {{ $vehicle->model }}</span>
                            <div class="flex space-x-2">
                                <!-- Botão Exibir -->
                                <button
                                    onclick="showModal('{{ $vehicle->model }}', '{{ $vehicle->brand }}', '{{ $vehicle->year }}', '{{ $vehicle->power }}','{{ $vehicle->category }}')"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Exibir
                                </button>
                                <!-- Botão Editar -->
                                <a href="/veiculos/edit/{{$vehicle->id}} " class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Editar
                                </a>
                                <!-- Botão Deletar -->
                                <form action="/veiculos/delete/{{$vehicle->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Você ainda não registrou nenhum veículo</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="vehicleModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Informações do Veículo</h2>
                <p><strong>Modelo:</strong> <span id="vehicleModel"></span></p>
                <p><strong>Marca:</strong> <span id="vehicleBrand"></span></p>
                <p><strong>Ano:</strong> <span id="vehicleYear"></span></p>
                <p><strong>Potência:</strong> <span id="vehiclePower"></span></p>
                <p><strong>Categoria:</strong> <span id="vehicleCategory"></span></p>
                <div class="flex justify-end mt-4">
                    <button
                        onclick="closeModal()"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fundo escurecido -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

    <script>
        function showModal(model, brand, year, power,category) {
            document.getElementById('vehicleModel').textContent = model;
            document.getElementById('vehicleBrand').textContent = brand;
            document.getElementById('vehicleYear').textContent = year;
            document.getElementById('vehiclePower').textContent = power;
            document.getElementById('vehicleCategory').textContent = category;
            document.getElementById('vehicleModal').classList.remove('hidden');
            document.getElementById('modalBackdrop').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('vehicleModal').classList.add('hidden');
            document.getElementById('modalBackdrop').classList.add('hidden');
        }
    </script>

</x-app-layout>
