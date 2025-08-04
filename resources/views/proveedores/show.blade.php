@extends('layouts.app')
@section('title', 'Proveedor: ' . $proveedor->nombre)
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $proveedor->nombre }}</h1>
        <div class="mb-2">Teléfono: {{ $proveedor->telefono }}</div>
        <div class="mb-2">Email: {{ $proveedor->email }}</div>
    </div>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Agregar producto</h2>
        <form action="{{ route('proveedores.productos.store', $proveedor) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
            @csrf
            <div>
                <label class="block text-sm">Nombre</label>
                <input type="text" name="nombre" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm">Precio</label>
        <!-- Se eliminaron las referencias a productos -->
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal de edición (simple, solo frontend) -->
        <div id="modalEditarProducto" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Editar producto</h3>
                <form id="formEditarProducto" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm">Nombre</label>
                        <input type="text" name="nombre" id="editNombre" class="border rounded px-3 py-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Precio</label>
                        <input type="number" name="precio" id="editPrecio" step="0.01" min="0" class="border rounded px-3 py-2 w-full" required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="cerrarModal()" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function editarProducto(id, nombre, precio) {
                document.getElementById('modalEditarProducto').classList.remove('hidden');
                document.getElementById('editNombre').value = nombre;
                document.getElementById('editPrecio').value = precio;
                document.getElementById('formEditarProducto').action = '/productos/' + id;
            }
            function cerrarModal() {
                document.getElementById('modalEditarProducto').classList.add('hidden');
            }
        </script>
    </div>
@endsection
