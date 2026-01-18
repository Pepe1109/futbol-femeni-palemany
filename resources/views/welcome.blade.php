<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lliga Femenina</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
        
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Panell de Control</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Iniciar Sessió</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-white bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded-md transition">Registrar-se</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
               <div class="text-6xl mb-8">⚽ 🏃‍♀️</div>
            </div>

            <div class="text-center mb-12">
                <h1 class="text-5xl font-black text-gray-900 mb-4">Lliga de Futbol Femení</h1>
                <p class="text-xl text-gray-600">Gestió professional d'equips, jugadores i partits en temps real.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                
                <div class="scale-100 p-6 bg-white rounded-lg shadow-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-blue-50 flex items-center justify-center rounded-full mb-4">
                            <span class="text-3xl">🛡️</span>
                        </div>
                        <h2 class="mt-2 text-xl font-semibold text-gray-900">Gestió d'Equips</h2>
                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Accedeix a la informació detallada de tots els clubs, els seus estadis i la seva història.
                        </p>
                    </div>
                </div>

                <div class="scale-100 p-6 bg-white rounded-lg shadow-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-green-50 flex items-center justify-center rounded-full mb-4">
                            <span class="text-3xl">📅</span>
                        </div>
                        <h2 class="mt-2 text-xl font-semibold text-gray-900">Resultats en Directe</h2>
                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            Segueix el calendari de partits i consulta la classificació actualitzada minut a minut.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/pepe1109" class="group inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Desenvolupat per Pepe 🚀
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>
</html>