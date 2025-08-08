<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('vendedores.index', compact('vendedores'));
    }

}
