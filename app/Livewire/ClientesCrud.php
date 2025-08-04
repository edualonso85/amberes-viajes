<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ClientesCrud extends Component
{
    // use LivewireAlert;
    
    public $clientes;
    public $nombre;
    public $telefono;
    public $email;
    public $cliente_id;
    public $modal; // Definir sin valor por defecto

    public function mount()
    {
        $this->modal = false;
    }
    public $modoEdicion = false;

    protected $rules = [
        'nombre' => 'required',
        'telefono' => 'nullable',
        'email' => 'nullable|email',
    ];

    public function render()
    {
        $this->clientes = Cliente::orderBy('id', 'desc')->get();
        return view('livewire.clientes-crud');
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombre', 'telefono', 'email', 'cliente_id', 'modoEdicion']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->cliente_id = $cliente->id;
        $this->nombre = $cliente->nombre;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->modoEdicion = true;
        $this->modal = true;
    }

    public function guardarCliente()
    {
        $this->validate();
        if ($this->modoEdicion && $this->cliente_id) {
            $cliente = Cliente::find($this->cliente_id);
            $cliente->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
        } else {
            Cliente::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
        }
        $this->cerrarModal();
        LivewireAlert::title('Item Saved')
            ->text('El cliente ha sido guardado correctamente en la base de datos.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function eliminarCliente($id = null)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }
        Cliente::find($id)?->delete();
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->reset(['nombre', 'telefono', 'email', 'cliente_id', 'modoEdicion']);
    }

    public function confirmarEliminar($id)
    {
        LivewireAlert::title('¿Estás seguro?')
            ->text('¿Quieres proceder con esta acción?')
            ->asConfirm()
            ->onConfirm('eliminarCliente', ['id' => $id])
            // ->withCancelButton('Cancelar')
            ->show();
    }

}
