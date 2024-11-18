<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #FF9800;">
            {{ __('Veículos Registrados') }}
        </h2>
    </x-slot>
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-6">
                        <h3 class="text-2xl font-bold mb-4" style="color: #FF9800;">{{ $user->name }}
                            ({{ $user->username }})
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($user->vehicles as $vehicle)
                                <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                                    <h4 class="text-lg font-bold mb-2" style="color: #FF9800;">{{ $vehicle->model }}
                                    </h4>
                                    <p class="text-gray-300"><strong>Marca:</strong> {{ $vehicle->brand }}</p>
                                    <p class="text-gray-300"><strong>Ano:</strong> {{ $vehicle->year }}</p>
                                    <p class="text-gray-300"><strong>Potência:</strong> {{ $vehicle->power }} cv</p>
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este veículo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                    <div class="p-6 ">
                        <p>Não há veículos!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
