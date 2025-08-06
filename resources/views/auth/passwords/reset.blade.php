@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 via-blue-400 to-blue-200 animate-fade-in">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-2xl border border-blue-100">
        <div class="flex flex-col items-center mb-4">
            <img src="https://api.iconify.design/mdi/lock-reset.svg?color=%230a3d62" alt="Reset" class="w-16 h-16 mb-2 animate-bounce">
            <h2 class="text-2xl font-extrabold text-blue-700 mb-1 tracking-tight">Restablecer contraseña</h2>
            <span class="text-base text-gray-500">Ingresa tu nueva contraseña</span>
        </div>
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block text-sm font-semibold text-blue-700">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus autocomplete="email"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 @error('email') border-red-500 @enderror transition">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-blue-700">Nueva contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 @error('password') border-red-500 @enderror transition">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password-confirm" class="block text-sm font-semibold text-blue-700">Confirmar contraseña</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg cursor-pointer transition">Restablecer contraseña</button>
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
