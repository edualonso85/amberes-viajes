<?php
namespace App\Http\Controllers;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['cliente', 'vendedor', 'aereos', 'terrestres'])->orderBy('id', 'desc')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function show($id)
    {
        $reserva = Reserva::with(['cliente', 'vendedor', 'aereos', 'terrestres'])->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

}
