<x-guest-layout>
    <div class="container">
        <h1 class="text-center text-xl font-bold" style="color: black;">Corrida: {{ $race->name }}</h1>
        <p style="color: black;"><strong>ID:</strong> {{ $race->id }}</p>
        <p style="color: black;"><strong>Categoria:</strong> {{ $race->category }}</p>
        <p style="color: black;"><strong>Número Máximo de Veículos:</strong> {{ $race->max_vehicles }}</p>
        <p style="color: black;"><strong>Data:</strong> {{ $race->date }}</p>
        <div class="flex justify-center space-x-4 mt-4">
            <a href="{{ route('races.edit', $race->id) }}" class="btn btn-warning" style="background-color: #FF9800; border: 2px solid #FF9800;">Editar</a>
            <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="background-color: #FF9800; border: 2px solid #FF9800;">Excluir</button>
            </form>
            <a href="{{ route('races.index') }}" class="btn btn-secondary" style="background-color: #FF9800; border: 2px solid #FF9800;">Voltar</a>
        </div>
    </div>
</x-guest-layout>
