<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vendedor;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class VendedoresCrud extends Component
{
    public $vendedores;
    public $nombre;
    public $apellido;
    public $comision;
    public $impuestos;
    public $vendedor_id;
    public $modal;
    public $modoEdicion = false;

    public function mount()
    {
        $this->modal = false;
    }

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'comision' => 'required|numeric',
        'impuestos' => 'required|numeric',
    ];

    public function render()
    {
        $this->vendedores = Vendedor::orderBy('id', 'desc')->get();
        return view('livewire.vendedores-crud');
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombre', 'apellido', 'comision', 'impuestos', 'vendedor_id', 'modoEdicion']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $vendedor = Vendedor::findOrFail($id);
        $this->vendedor_id = $vendedor->id;
        $this->nombre = $vendedor->nombre;
        $this->apellido = $vendedor->apellido;
        $this->comision = $vendedor->comision;
        $this->impuestos = $vendedor->impuestos;
        $this->modoEdicion = true;
        $this->modal = true;
    }

    public function guardarVendedor()
    {
        $this->validate();
        if ($this->modoEdicion && $this->vendedor_id) {
            $vendedor = Vendedor::find($this->vendedor_id);
            $vendedor->update([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'comision' => $this->comision,
                'impuestos' => $this->impuestos,
            ]);
        } else {
            Vendedor::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'comision' => $this->comision,
                'impuestos' => $this->impuestos,
            ]);
        }
        $this->cerrarModal();
        LivewireAlert::title('Item Saved')
            ->text('El vendedor ha sido guardado correctamente en la base de datos.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function eliminarVendedor($id = null)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }
        Vendedor::find($id)?->delete();
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->reset(['nombre', 'apellido', 'comision', 'impuestos', 'vendedor_id', 'modoEdicion']);
    }

    public function confirmarEliminar($id)
    {
        LivewireAlert::title('¿Estás seguro?')
            ->text('¿Quieres proceder con esta acción?')
            ->asConfirm()
            ->onConfirm('eliminarVendedor', ['id' => $id])
            // ->withCancelButton('Cancelar')
            ->show();
    }
}
