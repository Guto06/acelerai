<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Acelerai</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #0a161c;
            color: #FF9800;
        }
        .navbar {
            background-color: #0a161c;
        }
        .navbar a {
            color: #FF9800;
        }
    </style>
</head>
<body>
    <nav class="navbar flex justify-between items-center p-6">
        <!-- Logo no canto superior esquerdo -->
        <div class="text-2xl font-semibold">
            <a href="/">
                <img src="{{ asset('imagens/acelerai.png') }}" alt="Logo" class="w-32 h-32 ml-12" />
            </a>
        </div>

        <!-- Links -->
        @if (Route::has('login'))
            <nav class="space-x-4 font-semibold mr-11 mb-12">
                @auth
                    <a
                        href="{{ Auth::user()->is_administrator ? url('/dashboard') : url('/dashboard/user') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </nav>
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
    <!-- Main Content -->
    <div class="flex flex-col items-center justify-flex min-h-screen">
        <h1 class="text-5xl mb-8">Acelerai: Dominando o Rally!</h1>
        <p class="text-lg text-center">Prepare-se para as aventuras mais emocionantes nas pistas de rally!</p>
    </div>
</body>
</html>
