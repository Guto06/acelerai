<x-app-layout>
    @if (!Auth::user())
    <nav class="navbar flex justify-between items-center p-6 bg-gray-900 shadow-lg">
        <div class="text-2xl font-semibold">
            <a href="/">
                <img src="{{ asset('imagens/acelerai.png') }}" alt="Logo" class="w-32 h-32 ml-12" />
            </a>
        </div>
        @if (Route::has('login'))
            <div class="space-x-4 font-semibold mr-11">
                @auth
                    <a href="{{ Auth::user()->is_administrator ? url('/dashboard') : url('/dashboard/user') }}" class="text-white hover:text-yellow-500 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-500 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white hover:text-yellow-500 transition">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>
    @endif
    <div class="container mx-auto py-20 w-auto h-auto">
        <div class="bg-gray-800 p-10 rounded-lg shadow-xl max-w-4xl mx-auto">
            <div class="flex items-center space-x-6">
                <img class="w-32 h-32 rounded-full border-4 border-yellow-500 shadow-md transition-transform transform hover:scale-105" src="{{ $user->profile_picture }}">
                <div>
                    <h2 class="text-3xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-yellow-500 text-xl">{{ '@' . $user->username }} </p>
                </div>
            </div>
            <div class="mt-8 text-gray-300">
                <p>{{ $user->bio ?? 'Este usuário ainda não adicionou uma biografia.' }}</p>
            </div>
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-white">Veículos</h3>
                @if ($vehicles->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        @foreach ($vehicles as $vehicle)
                            <div class="bg-gray-900 p-5 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                                <h4 class="text-xl font-bold text-yellow-500">{{ $vehicle->model }} - Categoria {{ $vehicle->category }}</h4>
                                <p class="text-white">Marca: {{ $vehicle->brand }}</p>
                                <p class="text-white">Ano: {{ $vehicle->year }}</p>
                                <p class="text-white">Potência: {{ $vehicle->power }} cv</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 mt-6">Nenhum veículo cadastrado.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
