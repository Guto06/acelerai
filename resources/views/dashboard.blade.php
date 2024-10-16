<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
        {{ __('Dashboard') }}
    </h2>
</x-slot>


    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;"> 
            <div class="p-6 "> 
                @foreach ($users as $user)
                    <div class="flex justify-between items-center mb-4 border-b pb-4 border-black"> 
                        <!-- User info on the left -->
                        <div class="flex-1">
                            <p class="font-bold text-lg ">{{ $user->name }}</p> 
                            <p class="text-sm ">Email: {{ $user->email }}</p>
                            <p class="text-sm ">Username: {{ $user->username }}</p>
                            <p class="text-sm ">Número: {{ $user->number }}</p>
                            <p class="text-sm ">Idade: {{ $user->age }}</p>
                        </div>

                        <!-- Action buttons on the right -->
                        <div class="flex items-center space-x-4">
                            <!-- Download CNH button -->
                            <a href="{{ asset($user->license_path) }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Baixar CNH
                            </a>

                            <!-- Validate user button -->
                            <form action="{{ route('user.validate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                    Validar Usuário
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</x-app-layout>