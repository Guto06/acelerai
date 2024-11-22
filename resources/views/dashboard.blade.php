<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight shadow-white" style="color: #FF9800;">
        {{ __('Painel de Validação') }}
    </h2>
</x-slot>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<div class="container-fluid">
    <div class="row">
        @if(session('msg'))
            <div class="w-full max-w-lg mx-auto">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md animate-fade-in" role="alert">
                    <span class="block sm:inline">{{ session('msg') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.classList.add('hidden')">
                            <title>Fechar</title>
                            <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.935 2.935a1 1 0 01-1.414-1.414L8.586 10 5.651 7.065a1 1 0 111.414-1.414L10 8.586l2.935-2.935a1 1 0 111.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z"/>
                        </svg>
                    </span>
                </div>
            </div>
        @endif
    </div>
</div>


    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg" style="border: 5px solid #FF9800;"> 
            <div class="p-6 "> 
                @if (count($users) > 0)
                @foreach ($users as $user)
                    <div class="flex justify-between items-center mb-4 border-b pb-4 border-black"> 
                        <!-- User info on the left -->
                        <div class="flex-1">
                            <p class="font-bold text-lg ">{{ $user->name }}</p> 
                            <p class="text-sm ">Email: {{ $user->email }}</p>
                            <p class="text-sm ">Nome de usuário: {{ $user->username }}</p>
                            <p class="text-sm ">Número para contato: {{ $user->number }}</p>
                            <p class="text-sm ">Idade: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->age)->age }}</p>
                        </div>

                        <!-- Action buttons on the right -->
                        <div class="flex items-center space-x-4">
                            <!-- Download CNH button -->
                            <form action="{{ route('user.document', $user->id) }}" method="POST" target="_blank">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded" >
                                    Visualizar CNH
                                </button>
                            </form>

                            
                            <!-- Validate user button -->
                            <form action="{{ route('user.validate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                    Validar Usuário
                                </button>
                            </form>
                            <!-- Delete User button -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Excluir Usuário
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @else
                    <p>Não há usuários a serem validados!</p>
                @endif
            </div>
        </div>
    </div>
</div>

</x-app-layout>