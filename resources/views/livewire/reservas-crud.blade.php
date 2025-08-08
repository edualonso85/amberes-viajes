<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Reservas</h1>
        <button wire:click="abrirModalCrear" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Nueva
            Reserva</button>
    </div>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Cliente</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Vendedor</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr class="hover:bg-blue-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="py-2 px-4 border-b">{{ $reserva->cliente->nombre ?? '' }}</td>
                        <td class="py-2 px-4 border-b">{{ $reserva->vendedor->name ?? '' }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('reservas.show', $reserva->id) }}"
                                class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded mr-2 text-sm hover:cursor-pointer cursor-pointer">Ver</a>
                            <button wire:click="abrirModalEditar({{ $reserva->id }})"
                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm hover:cursor-pointer cursor-pointer">Editar</button>
                            <button wire:click="confirmarEliminar({{ $reserva->id }})"
                                class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm hover:cursor-pointer cursor-pointer">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div x-data="{ show: @entangle('modal') }" x-show="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;"
        @click.self="show = false; $wire.cerrarModal()">
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">{{ $modoEdicion ? 'Editar Reserva' : 'Nueva Reserva' }}</h2>
            <form wire:submit.prevent="guardarReserva">
                <div class="mb-4">
                    <label class="block">Cliente</label>
                    <select wire:model.defer="cliente_id" class="border rounded w-full px-3 py-2" required>
                        <option value="">Selecciona un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Vendedor</label>
                    <select wire:model.defer="vendedor_id" class="border rounded w-full px-3 py-2" required>
                        <option value="">Selecciona un vendedor</option>
                        @foreach($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                        @endforeach
                    </select>
                    @error('vendedor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <hr class="my-4">
                <h3 class="text-lg font-semibold mb-2">Aéreos</h3>
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <input type="text" wire:model.defer="aereoForm.codigo_aereo" placeholder="Código aéreo"
                        class="border rounded px-2 py-1">
                    <select wire:model.defer="aereoForm.proveedor" class="border rounded px-2 py-1">
                        <option value="">Selecciona un proveedor</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->nombre }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model.defer="aereoForm.origen" placeholder="Origen"
                        class="border rounded px-2 py-1">
                    <input type="text" wire:model.defer="aereoForm.destino" placeholder="Destino"
                        class="border rounded px-2 py-1">
                    <input type="date" wire:model.defer="aereoForm.fecha_salida" placeholder="Fecha salida"
                        class="border rounded px-2 py-1">
                    <input type="date" wire:model.defer="aereoForm.fecha_llegada" placeholder="Fecha llegada"
                        class="border rounded px-2 py-1">
                    <input type="text" wire:model.defer="aereoForm.horario_salida" placeholder="Horario salida"
                        class="border rounded px-2 py-1">
                    <input type="text" wire:model.defer="aereoForm.horario_llegada" placeholder="Horario llegada"
                        class="border rounded px-2 py-1">
                    <input type="number" step="0.01" wire:model.defer="aereoForm.monto_usd" placeholder="Monto USD"
                        class="border rounded px-2 py-1">
                    <input type="number" step="0.01" wire:model.defer="aereoForm.monto_pesos" placeholder="Monto Pesos"
                        class="border rounded px-2 py-1">
                    <input type="text" wire:model.defer="aereoForm.observaciones" placeholder="Observaciones"
                        class="border rounded px-2 py-1 col-span-2">
                </div>
                <button type="button" wire:click="agregarAereo"
                    class="bg-blue-400 text-white px-3 py-1 rounded mb-2 hover:cursor-pointer cursor-pointer">Agregar
                    aéreo</button>
                <ul class="mb-4">
                    @foreach($aereos as $i => $aereo)
                        <li class="flex gap-2 items-center mb-1 text-sm">
                            <span>{{ $aereo['codigo_aereo'] }} - {{ $aereo['proveedor'] }} ({{ $aereo['origen'] }} →
                                {{ $aereo['destino'] }})</span>
                            <button type="button" wire:click="eliminarAereo({{ $i }})"
                                class="text-red-500 hover:cursor-pointer cursor-pointer">Eliminar</button>
                        </li>
                    @endforeach
                </ul>
                <hr class="my-4">
                <h3 class="text-lg font-semibold mb-2">Terrestres</h3>
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <select wire:model.defer="terrestreForm.proveedor" class="border rounded px-2 py-1">
                        <option value="">Selecciona un proveedor</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->nombre }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model.defer="terrestreForm.descripcion_corta"
                        placeholder="Descripción corta" class="border rounded px-2 py-1">
                    <input type="date" wire:model.defer="terrestreForm.fecha_inicial" placeholder="Fecha inicial"
                        class="border rounded px-2 py-1">
                    <input type="date" wire:model.defer="terrestreForm.fecha_final" placeholder="Fecha final"
                        class="border rounded px-2 py-1">
                    <input type="number" step="0.01" wire:model.defer="terrestreForm.precio_usd"
                        placeholder="Precio USD" class="border rounded px-2 py-1">
                    <input type="number" step="0.01" wire:model.defer="terrestreForm.precio_pesos"
                        placeholder="Precio Pesos" class="border rounded px-2 py-1">
                </div>
                <button type="button" wire:click="agregarTerrestre"
                    class="bg-blue-400 text-white px-3 py-1 rounded mb-2 hover:cursor-pointer cursor-pointer">Agregar
                    terrestre</button>
                <ul class="mb-4">
                    @foreach($terrestres as $i => $terrestre)
                        <li class="flex gap-2 items-center mb-1 text-sm">
                            <span>{{ $terrestre['proveedor'] }} - {{ $terrestre['descripcion_corta'] }}
                                ({{ $terrestre['fecha_inicial'] }} → {{ $terrestre['fecha_final'] }})</span>
                            <button type="button" wire:click="eliminarTerrestre({{ $i }})"
                                class="text-red-500 hover:cursor-pointer cursor-pointer">Eliminar</button>
                        </li>
                    @endforeach
                </ul>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="show = false; $wire.cerrarModal()"
                        class="bg-gray-300 px-4 py-2 rounded hover:cursor-pointer cursor-pointer">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:cursor-pointer cursor-pointer">{{ $modoEdicion ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>