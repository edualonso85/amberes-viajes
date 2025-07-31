@extends('layouts.app')
@section('title', 'Clientes')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Cliente</a>
    </div>
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
                @foreach($clientes as $cliente)
                <tr class="hover:bg-blue-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-2 px-4 border-b">{{ $cliente->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $cliente->telefono }}</td>
                    <td class="py-2 px-4 border-b">{{ $cliente->email }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
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
