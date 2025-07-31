<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index() {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create() {
        return view('proveedores.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'nullable',
            'email' => 'nullable|email',
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedores.index');
    }

    public function edit(Proveedor $proveedor) {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor) {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'nullable',
            'email' => 'nullable|email',
        ]);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index');
    }

    public function show(Proveedor $proveedor) {
        return view('proveedores.show', compact('proveedor'));
    }

    public function destroy(Proveedor $proveedor) {
        $proveedor->delete();
        return redirect()->route('proveedores.index');
    }
}
