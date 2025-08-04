<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Amberes Admin</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="https://api.iconify.design/mdi/island.svg?color=%230a3d62" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div id="app">
        @auth
        <div class="flex min-h-screen">
            <aside x-data="{
                mini: localStorage.getItem('sidebarMini') === 'true',
                toggle() {
                    this.mini = !this.mini;
                    localStorage.setItem('sidebarMini', this.mini);
                }
            }" :class="mini ? 'w-20' : 'w-64'" class="bg-gradient-to-b from-blue-600 to-blue-400 text-white shadow-xl flex flex-col transition-all duration-200">
                <div class="flex items-center justify-between px-4 py-5 border-b border-blue-500 h-20">
                    <div class="flex items-center gap-3" x-show="!mini">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" /></svg>
                        <span class="font-extrabold text-2xl tracking-tight leading-tight">Amberes Viajes</span>
                    </div>
                    <button @click="toggle()" class="ml-auto bg-blue-700 hover:bg-blue-800 rounded-full p-2 transition flex items-center justify-center" :title="mini ? 'Expandir menú' : 'Minimizar menú'">
                        <svg x-show="!mini" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5" /></svg>
                        <svg x-show="mini" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16" /></svg>
                    </button>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden cursor-pointer">
                <button @click="sidebarOpen = false" class="text-gray-500 focus:outline-none cursor-pointer">
                </div>
                <nav class="mt-6 flex-1">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3 rounded-l-full hover:bg-blue-700 transition font-semibold {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" /></svg>
                                <span x-show="!mini">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('clientes.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-l-full hover:bg-blue-700 transition font-semibold {{ request()->routeIs('clientes.*') ? 'bg-blue-800' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87v-2a4 4 0 00-3-3.87m6 5.87a4 4 0 01-3-3.87m0 0a4 4 0 00-3-3.87m0 0V7a4 4 0 018 0v2a4 4 0 01-3 3.87z" /></svg>
                                <span x-show="!mini">Clientes</span>
                            </a>
                        </li>
                        @if(auth()->user() && auth()->user()->role !== 'vendedor')
                            <li>
                                <a href="{{ route('vendedores.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-l-full hover:bg-blue-700 transition font-semibold {{ request()->routeIs('vendedores.*') ? 'bg-blue-800' : '' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87v-2a4 4 0 00-3-3.87m6 5.87a4 4 0 01-3-3.87m0 0a4 4 0 00-3-3.87m0 0V7a4 4 0 018 0v2a4 4 0 01-3 3.87z" /></svg>
                                    <span x-show="!mini">Vendedores</span>
                                </a>
                                <a href="{{ route('usuarios.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-l-full hover:bg-blue-700 transition font-semibold {{ request()->routeIs('usuarios.*') ? 'bg-blue-800' : '' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    <span x-show="!mini">Usuarios</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('proveedores.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-l-full hover:bg-blue-700 transition font-semibold {{ request()->routeIs('proveedores.*') ? 'bg-blue-800' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10-5h3a1 1 0 011 1v4a1 1 0 01-1 1h-3m-10 0v6a2 2 0 002 2h4a2 2 0 002-2v-6m-8 0h8" /></svg>
                                <span x-show="!mini">Proveedores</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div :class="mini ? 'mt-auto mb-6 px-2' : 'mt-auto mb-6 px-6'">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            :class="mini ? 'px-2 py-3 justify-center' : 'px-6 py-3'"
                            class="flex items-center gap-3 rounded-full bg-blue-700 hover:bg-blue-900 active:scale-95 shadow-lg transition font-bold w-full cursor-pointer border border-blue-900 text-white text-base focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" /></svg>
                            <span x-show="!mini">Cerrar sesión</span>
                        </button>
                    </form>
                </div>
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
@livewireScripts
</html>
