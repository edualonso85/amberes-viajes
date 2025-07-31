<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
        @vite('resources/css/app.css')
</head>
<body>
    <div id="app">
        @auth
        <div class="flex min-h-screen">
            <aside class="w-64 bg-white shadow-md">
                <div class="p-6 font-bold text-xl border-b">Menú</div>
                <nav class="mt-4">
                    <ul>
                        <li><a href="{{ route('dashboard') }}" class="block px-6 py-2 hover:bg-gray-200 cursor-pointer">Dashboard</a></li>
                        <li><a href="{{ route('clientes.index') }}" class="block px-6 py-2 hover:bg-gray-200 cursor-pointer">Clientes</a></li>
                        <li><a href="{{ route('proveedores.index') }}" class="block px-6 py-2 hover:bg-gray-200 cursor-pointer">Proveedores</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-2 hover:bg-gray-200 cursor-pointer">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="flex-1 p-8 bg-gray-100 min-h-screen">
                @yield('content')
            </main>
        </div>
        @else
        <main class="py-4">
            @yield('content')
        </main>
        @endauth
    </div>
</body>
</html>
