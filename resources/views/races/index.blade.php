<x-guest-layout>
    <div class="container">
        <h1 class="text-center text-xl font-bold" style="color: black;">Corridas</h1>
        <a href="{{ route('races.create') }}" class="btn btn-primary" style="background-color: #FF9800; border: 2px solid #FF9800;">Criar Nova Corrida</a>
        <table class="table">
            <thead>
                <tr style="color: black;">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($races as $race)
                <tr style="color: black;">
                    <td>{{ $race->id }}</td>
                    <td>{{ $race->name }}</td>
                    <td>{{ $race->category }}</td>
                    <td>{{ $race->date }}</td>
                    <td>
                        <a href="{{ route('races.show', $race->id) }}" class="btn btn-info" style="background-color: #FF9800; border: 2px solid #FF9800;">Ver</a>
                        <a href="{{ route('races.edit', $race->id) }}" class="btn btn-warning" style="background-color: #FF9800; border: 2px solid #FF9800;">Editar</a>
                        <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: #FF9800; border: 2px solid #FF9800;">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-guest-layout>
