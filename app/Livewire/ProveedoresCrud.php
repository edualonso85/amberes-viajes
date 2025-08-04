<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proveedor;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ProveedoresCrud extends Component
{
    public $proveedores;
    public $nombre;
    public $telefono;
    public $email;
    public $proveedor_id;
    public $modal;
    public $modoEdicion = false;

    public function mount()
    {
        $this->modal = false;
    }

    protected $rules = [
        'nombre' => 'required',
        'telefono' => 'nullable',
        'email' => 'nullable|email',
    ];

    public function render()
    {
        $this->proveedores = Proveedor::orderBy('id', 'desc')->get();
        return view('livewire.proveedores-crud');
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombre', 'telefono', 'email', 'proveedor_id', 'modoEdicion']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $this->proveedor_id = $proveedor->id;
        $this->nombre = $proveedor->nombre;
        $this->telefono = $proveedor->telefono;
        $this->email = $proveedor->email;
        $this->modoEdicion = true;
        $this->modal = true;
    }

    public function guardarProveedor()
    {
        $this->validate();
        if ($this->modoEdicion && $this->proveedor_id) {
            $proveedor = Proveedor::find($this->proveedor_id);
            $proveedor->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
        } else {
            Proveedor::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
        }
        $this->cerrarModal();
        LivewireAlert::title('Item Saved')
            ->text('El proveedor ha sido guardado correctamente en la base de datos.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function eliminarProveedor($id = null)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }
        Proveedor::find($id)?->delete();
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->reset(['nombre', 'telefono', 'email', 'proveedor_id', 'modoEdicion']);
    }

    public function confirmarEliminar($id)
    {
        LivewireAlert::title('¿Estás seguro?')
            ->text('¿Quieres proceder con esta acción?')
            ->asConfirm()
            ->onConfirm('eliminarProveedor', ['id' => $id])
            // ->withCancelButton('Cancelar')
            ->show();
    }
}
