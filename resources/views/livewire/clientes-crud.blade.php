<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Clientes</h1>
        <button wire:click="abrirModalCrear" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Nuevo
            Cliente</button>
    </div>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Nombre</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Teléfono</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Email</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Fecha de nacimiento</th>
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
                            {{ $cliente->fecha_nacimiento ? \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') : '' }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="abrirModalEditar({{ $cliente->id }})"
                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Editar</button>
                            <button wire:click="confirmarEliminar({{ $cliente->id }})"
                                class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm cursor-pointer">Eliminar</button>
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
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ $modoEdicion ? 'Editar Cliente' : 'Nuevo Cliente' }}</h2>
            <form wire:submit.prevent="guardarCliente">
                <div class="mb-4">
                    <label class="block">Nombre</label>
                    <input type="text" wire:model.defer="nombre" class="border rounded w-full px-3 py-2" required>
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Teléfono</label>
                    <input type="text" wire:model.defer="telefono" class="border rounded w-full px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" wire:model.defer="email" class="border rounded w-full px-3 py-2">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Fecha de nacimiento</label>
                    <input type="date" wire:model.defer="fecha_nacimiento" class="border rounded w-full px-3 py-2">
                    @error('fecha_nacimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="show = false; $wire.cerrarModal()"
                        class="bg-gray-300 px-4 py-2 rounded cursor-pointer">Cancelar</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">{{ $modoEdicion ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>