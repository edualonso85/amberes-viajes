@extends('layouts.app')
@section('title', 'Nuevo Vendedor')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-4">Nuevo Vendedor</h1>
        <form action="{{ route('vendedores.store') }}" method="POST" class="max-w-lg">
            @csrf
            <div class="mb-4">
                <label class="block text-sm">Nombre</label>
                <input type="text" name="nombre" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm">Apellido</label>
                <input type="text" name="apellido" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm">Comisión</label>
                <input type="number" name="comision" step="0.01" min="0" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm">Impuestos</label>
                <input type="number" name="impuestos" step="0.01" min="0" class="border rounded px-3 py-2 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
            <a href="{{ route('vendedores.index') }}" class="ml-2 text-gray-600">Cancelar</a>
        </form>
    </div>
@endsection
