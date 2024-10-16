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
                        href="{{ url('/dashboard') }}"
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

    <!-- Main Content -->
    <div class="flex flex-col items-center justify-flex min-h-screen">
        <h1 class="text-5xl mb-8">Acelerai: Dominando o Rally!</h1>
        <p class="text-lg text-center">Prepare-se para as aventuras mais emocionantes nas pistas de rally!</p>
    </div>
</body>
</html>
