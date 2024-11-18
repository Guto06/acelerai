<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-7xl mx-auto" style="border: 3px solid #FF9800;">
            <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">Gerenciar Pilotos</h1>
            <div class="mb-4">
                <input type="text" id="search" placeholder="Buscar Piloto" class="w-full p-2 rounded-md shadow-sm"
                    style="border: 2px solid #FF9800; background-color: #2d3748; color: white;">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pilots as $pilot)
                    <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-2" style="color: #FF9800;">{{ $pilot->name }}</h2>
                        <p class="text-white"><strong>Email:</strong> {{ $pilot->email }}</p>
                        <p class="text-white"><strong>Nome de usuário:</strong> {{ $pilot->username }}</p>
                        <p class="text-white"><strong>Número para contato:</strong> {{ $pilot->number }}</p>
                        <p class="text-white"><strong>Idade:</strong>
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pilot->age)->age }}</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('admin.users.edit', $pilot->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition-all duration-300 ease-in-out">
                                Editar
                            </a>
                            <form action="{{ route('user.destroy', $pilot->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
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
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let searchValue = this.value.toLowerCase();
            let pilots = document.querySelectorAll('.bg-gray-700');

            pilots.forEach(function(pilot) {
                let name = pilot.querySelector('h2').textContent.toLowerCase();
                if (name.includes(searchValue)) {
                    pilot.style.display = 'block';
                } else {
                    pilot.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
