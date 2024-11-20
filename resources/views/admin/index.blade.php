<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl mx-auto" style="border: 3px solid #FF9800;">
            <h1 class="text-3xl font-bold mb-4" style="color: #FF9800;">Painel Administrativo</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('admin.users.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out text-center">
                    Gerenciar Pilotos
                </a>
                <a href="{{ route('admin.vehicles') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out text-center">
                    Gerenciar Veículos
                </a>
                <a href="{{ route('admin.race') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out text-center">
                    Gerenciar Corridas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>