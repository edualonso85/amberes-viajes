@extends('layouts.app')
@section('title', 'Vendedor: ' . $vendedor->nombre . ' ' . $vendedor->apellido)
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $vendedor->nombre }} {{ $vendedor->apellido }}</h1>
        <div class="mb-2">Comisión: {{ number_format($vendedor->comision, 2) }}%</div>
        <div class="mb-2">Impuestos: {{ number_format($vendedor->impuestos, 2) }}%</div>
        <a href="{{ route('vendedores.edit', $vendedor) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
        <a href="{{ route('vendedores.index') }}" class="ml-2 text-gray-600">Volver</a>
    </div>
@endsection
