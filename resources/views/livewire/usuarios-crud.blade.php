<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Usuarios</h1>
        <button wire:click="abrirModalCrear" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Nuevo
            Usuario</button>
    </div>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">ID</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Nombre</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Email</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Teléfono</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Rol</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr class="hover:bg-blue-50 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="py-2 px-4 border-b">{{ $usuario->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $usuario->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $usuario->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $usuario->telefono }}</td>
                        <td class="py-2 px-4 border-b">{{ $usuario->role }}</td>
                        <td class="py-2 px-4 border-b space-x-2">
                            <button wire:click="abrirModalEditar({{ $usuario->id }})"
                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 text-sm cursor-pointer">Editar</button>
                            <button wire:click="confirmarEliminar({{ $usuario->id }})"
                                class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm cursor-pointer">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div x-data="{ show: @entangle('modal') }" x-show="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;">
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-md" @click.self="show = false; $wire.cerrarModal()">
            <h2 class="text-xl font-bold mb-4">{{ $modoEdicion ? 'Editar Usuario' : 'Nuevo Usuario' }}</h2>
            <form wire:submit.prevent="guardarUsuario">
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
                    <label class="block">Rol</label>
                    <select wire:model.defer="role" class="border rounded w-full px-3 py-2">
                        <option value="">Selecciona un rol</option>
                        <option value="admin">Administrador</option>
                        <option value="vendedor">Vendedor</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block">Contraseña</label>
                    <input type="password" wire:model.defer="password" class="border rounded w-full px-3 py-2"
                        @if(!$modoEdicion) required @endif>
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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