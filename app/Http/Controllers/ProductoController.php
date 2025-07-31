<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;

class ProductoController extends Controller
{
    public function store(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
        ]);
        $proveedor->productos()->create($request->only('nombre', 'precio'));
        return redirect()->route('proveedores.show', $proveedor)->with('success', 'Producto agregado correctamente');
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
        ]);
        $producto->update($request->only('nombre', 'precio'));
        return redirect()->route('proveedores.show', $producto->proveedor_id)->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $proveedorId = $producto->proveedor_id;
        $producto->delete();
        return redirect()->route('proveedores.show', $proveedorId)->with('success', 'Producto eliminado correctamente');
    }
}
