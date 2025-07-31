@extends('layouts.app')
@section('title', 'Editar Cliente')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block">Nombre</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="border rounded w-full px-3 py-2" required>
        </div>
        <div>
            <label class="block">Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="border rounded w-full px-3 py-2">
        </div>
        <div>
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ $cliente->email }}" class="border rounded w-full px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
@endsection
