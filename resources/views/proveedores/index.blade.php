@extends('layouts.app')
@section('title', 'Proveedores')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Proveedores</h1>
        <a href="{{ route('proveedores.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Proveedor</a>
    </div>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Nombre</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Teléfono</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Email</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                <tr class="hover:bg-blue-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-2 px-4 border-b">{{ $proveedor->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $proveedor->telefono }}</td>
                    <td class="py-2 px-4 border-b">{{ $proveedor->email }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('proveedores.show', $proveedor) }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Productos</a>
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Editar</a>
                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proveedor? Esta acción no se puede deshacer.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm cursor-pointer">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
