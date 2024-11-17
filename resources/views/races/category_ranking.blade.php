<x-app-layout>
    <div class="container mx-auto py-20 w-auto h-auto">
        <div class="bg-gray-800 p-10 rounded-lg shadow-xl max-w-4xl mx-auto" style="border: 3px solid #FF9800;">
            <div class="mt-2">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">Classificação Geral da Temporada - Categoria {{ $category }}</h1>
                    <table class="min-w-full bg-white mb-8">
                        <thead>
                            <tr>
                                <th class="py-2">Posição</th>
                                <th class="py-2">Piloto</th>
                                <th class="py-2">Pontuação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pilotPoints as $index => $pilot)
                                <tr class="{{ $index === 0 ? 'bg-green-200' : '' }}">
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $pilot['name'] }}</td>
                                    <td class="border px-4 py-2">{{ $pilot['points'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>