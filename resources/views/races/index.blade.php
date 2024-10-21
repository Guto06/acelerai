<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
            {{ __('Corridas') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <div class="container-fluid py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a161c] overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;">
                <div class="p-6">
                    <!-- Botão Criar Nova Corrida -->
             <div class="text-right mb-4">
                <a href="{{ route('races.create') }}" style="background-color: #FF9800;" class="hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow transition-all duration-300 ease-in-out">
                     Criar Nova Corrida
                </a>
            </div>


                    <!-- Tabela de Corridas -->
                    <table class="min-w-full bg-gray-900 rounded-lg overflow-hidden shadow-lg">
                        <thead>
                            <tr class="bg-orange-500 text-white text-lg">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Nome</th>
                                <th class="py-3 px-6 text-left">Categoria</th>
                                <th class="py-3 px-6 text-left">Data</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($races as $race)
                            <tr class="border-b border-gray-700 text-white hover:bg-gray-700 transition-all duration-300 ease-in-out">
                                <td class="py-3 px-6">{{ $race->id }}</td>
                                <td class="py-3 px-6">{{ $race->name }}</td>
                                <td class="py-3 px-6">{{ $race->category }}</td>
                                <td class="py-3 px-6">{{ $race->date }}</td>
                                <td class="py-3 px-6 text-center flex justify-around">
                                    <a href="{{ route('races.show', $race->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded shadow transition-all duration-300 ease-in-out">Ver</a>
                                    <a href="{{ route('races.edit', $race->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded shadow transition-all duration-300 ease-in-out">Editar</a>
                                    <form action="{{ route('races.destroy', $race->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta corrida?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded shadow transition-all duration-300 ease-in-out">Excluir</button>
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