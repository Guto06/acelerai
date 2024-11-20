<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
            {{ __('Resultado da Corrida') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <div class="container-fluid">
        <div class="row">
            @if (session('msg'))
                <div class="w-full max-w-lg mx-auto">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md animate-fade-in"
                        role="alert">
                        <span class="block sm:inline">{{ session('msg') }}</span>
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
    <div class="container mx-auto py-4 w-auto h-auto">
        <div class="bg-[#0a161c] p-10 rounded-lg shadow-xl max-w-4xl mx-auto" style="border: 3px solid #FF9800;">
            <div class="mt-2">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">Resultado: {{ $race->name }}
                    </h1>
                    <table class="min-w-full bg-[#0a161c] mb-8 rounded-lg" style="border: 3px solid #FF9800;">
                        <thead style="color: #ffff">
                            <tr>
                                <th class="py-2">Piloto - Veículo</th>
                                <th class="py-2">Posição</th>
                                <th class="py-2">Tempo</th>
                                <th class="py-2">Consumo de Combustível</th>
                                <th class="py-2">Velocidade Média</th>
                                <th class="py-2">Condição do Carro</th>
                                <th class="py-2">Pontos</th>
                                <th class="py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raceVehicles as $raceVehicle)
                                <tr style="color: #ffff">
                                    <td class="border px-4 py-2">{{ $raceVehicle->vehicle->user->name }} -
                                        {{ $raceVehicle->vehicle->model }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->position }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->time }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->fuel_consumption }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->average_speed }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->car_condition }}</td>
                                    <td class="border px-4 py-2">{{ $raceVehicle->points }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.race-vehicles.edit', [$race->id, $raceVehicle->vehicle->id]) }}"
                                            class="text-blue-500 hover:underline">Editar</a>
                                        <form
                                            action="{{ route('admin.race-vehicles.delete', [$race->id, $raceVehicle->vehicle->id]) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
