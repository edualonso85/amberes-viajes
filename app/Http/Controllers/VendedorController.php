<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('vendedores.index', compact('vendedores'));
    }

    public function create()
    {
        return view('vendedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'comision' => 'required|numeric',
            'impuestos' => 'required|numeric',
        ]);
        Vendedor::create($request->all());
        return redirect()->route('vendedores.index')->with('success', 'Vendedor creado correctamente');
    }

    public function show(Vendedor $vendedor)
    {
        return view('vendedores.show', compact('vendedor'));
    }

    public function edit(Vendedor $vendedor)
    {
        return view('vendedores.edit', compact('vendedor'));
    }

    public function update(Request $request, Vendedor $vendedor)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'comision' => 'required|numeric',
            'impuestos' => 'required|numeric',
        ]);
        $vendedor->update($request->all());
        return redirect()->route('vendedores.index')->with('success', 'Vendedor actualizado correctamente');
    }

    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();
        return redirect()->route('vendedores.index')->with('success', 'Vendedor eliminado correctamente');
    }
}
