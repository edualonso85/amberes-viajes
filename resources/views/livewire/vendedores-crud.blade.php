<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Vendedores</h1>
        <button wire:click="abrirModalCrear" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Nuevo Vendedor</button>
    </div>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Nombre</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Apellido</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Comisión (%)</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Impuestos (%)</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendedores as $vendedor)
                <tr class="hover:bg-blue-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-2 px-4 border-b">{{ $vendedor->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $vendedor->apellido }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($vendedor->comision, 2) }}%</td>
                    <td class="py-2 px-4 border-b">{{ number_format($vendedor->impuestos, 2) }}%</td>
                    <td class="py-2 px-4 border-b">
                        <button wire:click="abrirModalEditar({{ $vendedor->id }})" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Editar</button>
                        <button wire:click="confirmarEliminar({{ $vendedor->id }})" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm cursor-pointer">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div x-data="{ show: @entangle('modal') }" x-show="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;">
        <!-- Modal principal -->
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ $modoEdicion ? 'Editar Vendedor' : 'Nuevo Vendedor' }}</h2>
            <form wire:submit.prevent="guardarVendedor">
                <div class="mb-4">
                    <label class="block">Nombre</label>
                    <input type="text" wire:model.defer="nombre" class="border rounded w-full px-3 py-2" required>
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Apellido</label>
                    <input type="text" wire:model.defer="apellido" class="border rounded w-full px-3 py-2" required>
                    @error('apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Comisión (%)</label>
                    <input type="number" step="0.01" wire:model.defer="comision" class="border rounded w-full px-3 py-2" required>
                    @error('comision') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Impuestos (%)</label>
                    <input type="number" step="0.01" wire:model.defer="impuestos" class="border rounded w-full px-3 py-2" required>
                    @error('impuestos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="show = false; $wire.cerrarModal()" class="bg-gray-300 px-4 py-2 rounded cursor-pointer">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">{{ $modoEdicion ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>        
    </div>
</div>
