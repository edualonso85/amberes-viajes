
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 via-blue-400 to-blue-200 animate-fade-in">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-2xl border border-blue-100">
        <div class="flex flex-col items-center mb-4">
            <img src="https://api.iconify.design/mdi/island.svg?color=%230a3d62" alt="Logo" class="w-16 h-16 mb-2 animate-bounce">
            <h2 class="text-3xl font-extrabold text-blue-700 mb-1 tracking-tight">Amberes Viajes</h2>
            <span class="text-base text-gray-500">Accede a tu cuenta</span>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-blue-700">Correo electrónico</label>
                <div class="relative mt-1">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        class="block w-full pl-2 pr-4 py-2 rounded-xl bg-gray-50 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 @error('email') border-red-500 @enderror shadow-sm transition duration-200">
                </div>
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-blue-700">Contraseña</label>
                <div class="relative mt-1">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full pl-2 pr-4 py-2 rounded-xl bg-gray-50 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 @error('password') border-red-500 @enderror shadow-sm transition duration-200">
                </div>
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-700" for="remember">Recordarme</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg cursor-pointer transition">Entrar</button>
        </form>
    </div>
</div>
<style>
@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in { animation: fade-in 0.7s ease; }
</style>
<style>
.bg-gray-50 { background-color: #f9fafb; }
.rounded-xl { border-radius: 0.75rem; }
.transition { transition: all 0.2s; }
</style>
</style>
@endsection
