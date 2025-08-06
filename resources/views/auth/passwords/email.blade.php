@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 via-blue-400 to-blue-200 animate-fade-in">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-2xl border border-blue-100">
        <div class="flex flex-col items-center mb-4">
            <img src="https://api.iconify.design/mdi/email-lock.svg?color=%230a3d62" alt="Email" class="w-16 h-16 mb-2 animate-bounce">
            <h2 class="text-2xl font-extrabold text-blue-700 mb-1 tracking-tight">¿Olvidaste tu contraseña?</h2>
            <span class="text-base text-gray-500">Ingresa tu correo para recibir el enlace</span>
        </div>
        @if (session('status'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-center">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-blue-700">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 @error('email') border-red-500 @enderror transition">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg cursor-pointer transition">Enviar enlace de recuperación</button>
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
@endsection
