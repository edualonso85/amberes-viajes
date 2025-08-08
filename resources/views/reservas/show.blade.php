@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded shadow p-8 mt-8">
        <h1 class="text-3xl font-bold mb-6 text-blue-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline-block text-blue-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m-4-5v9" />
            </svg>
            Detalle de Reserva
        </h1>
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 rounded p-4">
                <div class="font-semibold text-blue-800 mb-2">Cliente</div>
                <div class="text-gray-700">{{ $reserva->cliente->nombre ?? '-' }}</div>
            </div>
            <div class="bg-blue-50 rounded p-4">
                <div class="font-semibold text-blue-800 mb-2">Vendedor</div>
                <div class="text-gray-700">{{ $reserva->vendedor->name ?? '-' }}</div>
            </div>
        </div>
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-blue-600 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6h13M9 6l-7 7 7 7" />
                </svg>
                Aéreos
            </h2>
            <div class="grid gap-4">
                @forelse($reserva->aereos as $aereo)
                    <div class="bg-white border border-blue-100 rounded p-4 shadow-sm">
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Código:</span> {{ $aereo->codigo_aereo }}</div>
                            <div><span class="font-semibold">Proveedor:</span> {{ $aereo->proveedor }}</div>
                            <div><span class="font-semibold">Origen:</span> {{ $aereo->origen }}</div>
                            <div><span class="font-semibold">Destino:</span> {{ $aereo->destino }}</div>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Fecha salida:</span> {{ $aereo->fecha_salida }}</div>
                            <div><span class="font-semibold">Fecha llegada:</span> {{ $aereo->fecha_llegada }}</div>
                            <div><span class="font-semibold">Horario salida:</span> {{ $aereo->horario_salida }}</div>
                            <div><span class="font-semibold">Horario llegada:</span> {{ $aereo->horario_llegada }}</div>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Monto USD:</span> <span
                                    class="text-green-700">{{ $aereo->monto_usd }}</span></div>
                            <div><span class="font-semibold">Monto Pesos:</span> <span
                                    class="text-green-700">{{ $aereo->monto_pesos }}</span></div>
                        </div>
                        <div><span class="font-semibold">Observaciones:</span> {{ $aereo->observaciones }}</div>
                    </div>
                @empty
                    <div class="text-gray-500">No hay aéreos asociados.</div>
                @endforelse
            </div>
        </div>
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-blue-600 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6" />
                </svg>
                Terrestres
            </h2>
            <div class="grid gap-4">
                @forelse($reserva->terrestres as $terrestre)
                    <div class="bg-white border border-blue-100 rounded p-4 shadow-sm">
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Proveedor:</span> {{ $terrestre->proveedor }}</div>
                            <div><span class="font-semibold">Descripción corta:</span> {{ $terrestre->descripcion_corta }}</div>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Fecha inicial:</span> {{ $terrestre->fecha_inicial }}</div>
                            <div><span class="font-semibold">Fecha final:</span> {{ $terrestre->fecha_final }}</div>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-2">
                            <div><span class="font-semibold">Precio USD:</span> <span
                                    class="text-green-700">{{ $terrestre->precio_usd }}</span></div>
                            <div><span class="font-semibold">Precio Pesos:</span> <span
                                    class="text-green-700">{{ $terrestre->precio_pesos }}</span></div>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500">No hay terrestres asociados.</div>
                @endforelse
            </div>
        </div>
        <a href="{{ route('reservas.index') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Volver</a>
    </div>
@endsection