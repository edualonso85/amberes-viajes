@extends('layouts.app')
@section('title', 'Nuevo Proveedor')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuevo Proveedor</h1>
    <form action="{{ route('proveedores.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nombre</label>
            <input type="text" name="nombre" class="border rounded w-full px-3 py-2" required>
        </div>
        <div>
            <label class="block">Teléfono</label>
            <input type="text" name="telefono" class="border rounded w-full px-3 py-2">
        </div>
        <div>
            <label class="block">Email</label>
            <input type="email" name="email" class="border rounded w-full px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
    </form>
@endsection
