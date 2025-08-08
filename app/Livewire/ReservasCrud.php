<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Proveedor;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ReservasCrud extends Component
    // ...existing code...
    // Importar correctamente la facade
{
    public $reservas;
    public $clientes;
    public $vendedores;
    public $proveedores;
    public $cliente_id;
    public $vendedor_id;
    public $reserva_id;
    public $modal = false;
    public $modoEdicion = false;
    public $aereos = [];
    public $aereoForm = [
        'codigo_aereo' => '',
        'proveedor' => '',
        'origen' => '',
        'destino' => '',
        'fecha_salida' => '',
        'fecha_llegada' => '',
        'horario_salida' => '',
        'horario_llegada' => '',
        'monto_usd' => '',
        'monto_pesos' => '',
        'observaciones' => ''
    ];
    public $terrestres = [];
    public $terrestreForm = [
        'proveedor' => '',
        'descripcion_corta' => '',
        'fecha_inicial' => '',
        'fecha_final' => '',
        'precio_usd' => '',
        'precio_pesos' => ''
    ];

    protected $rules = [
        'cliente_id' => 'required|exists:clientes,id',
        'vendedor_id' => 'required|exists:users,id',
    ];

    public function mount()
    {
        $this->clientes = Cliente::all();
        $this->vendedores = User::where('role', 'vendedor')->get();
        $this->proveedores = Proveedor::all();
    }

    public function render()
    {
        $this->reservas = Reserva::with(['cliente', 'vendedor'])->orderBy('id', 'desc')->get();
        return view('livewire.reservas-crud');
    }

    public function abrirModalCrear()
    {
        $this->reset(['cliente_id', 'vendedor_id', 'reserva_id', 'modoEdicion', 'aereos', 'terrestres']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $reserva = Reserva::with(['aereos', 'terrestres'])->findOrFail($id);
        $this->reserva_id = $reserva->id;
        $this->cliente_id = $reserva->cliente_id;
        $this->vendedor_id = $reserva->vendedor_id;
        $this->aereos = $reserva->aereos->toArray();
        $this->terrestres = $reserva->terrestres->toArray();
        $this->modoEdicion = true;
        $this->modal = true;
    }

    public function guardarReserva()
    {
        $this->validate();
        if ($this->modoEdicion && $this->reserva_id) {
            $reserva = Reserva::find($this->reserva_id);
            $reserva->update([
                'cliente_id' => $this->cliente_id,
                'vendedor_id' => $this->vendedor_id,
            ]);
            $reserva->aereos()->delete();
            $reserva->terrestres()->delete();
        } else {
            $reserva = Reserva::create([
                'cliente_id' => $this->cliente_id,
                'vendedor_id' => $this->vendedor_id,
            ]);
        }
        foreach ($this->aereos as $aereo) {
            $aereo['monto_usd'] = $aereo['monto_usd'] === '' ? 0 : $aereo['monto_usd'];
            $aereo['monto_pesos'] = $aereo['monto_pesos'] === '' ? 0 : $aereo['monto_pesos'];
            $reserva->aereos()->create($aereo);
        }
        foreach ($this->terrestres as $terrestre) {
            $terrestre['precio_usd'] = $terrestre['precio_usd'] === '' ? 0 : $terrestre['precio_usd'];
            $terrestre['precio_pesos'] = $terrestre['precio_pesos'] === '' ? 0 : $terrestre['precio_pesos'];
            $reserva->terrestres()->create($terrestre);
        }
        $this->cerrarModal();
        LivewireAlert::title('Reserva guardada')
            ->text('La reserva ha sido guardada correctamente en la base de datos.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function eliminarReserva($id = null)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }
        Reserva::find($id)?->delete();
    }

    public function confirmarEliminar($id)
    {
        LivewireAlert::title('¿Estás seguro?')
            ->text('¿Quieres proceder con esta acción?')
            ->asConfirm()
            ->onConfirm('eliminarReserva', ['id' => $id])
            ->show();
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->reset(['cliente_id', 'vendedor_id', 'reserva_id', 'modoEdicion', 'aereos', 'terrestres']);
    }

    public function agregarAereo()
    {
        $this->aereos[] = $this->aereoForm;
        $this->aereoForm = [
            'codigo_aereo' => '',
            'proveedor' => '',
            'origen' => '',
            'destino' => '',
            'fecha_salida' => '',
            'fecha_llegada' => '',
            'horario_salida' => '',
            'horario_llegada' => '',
            'monto_usd' => '',
            'monto_pesos' => '',
            'observaciones' => ''
        ];
    }
    public function eliminarAereo($index)
    {
        unset($this->aereos[$index]);
        $this->aereos = array_values($this->aereos);
    }
    public function agregarTerrestre()
    {
        $this->terrestres[] = $this->terrestreForm;
        $this->terrestreForm = [
            'proveedor' => '',
            'descripcion_corta' => '',
            'fecha_inicial' => '',
            'fecha_final' => '',
            'precio_usd' => '',
            'precio_pesos' => ''
        ];
    }
    public function eliminarTerrestre($index)
    {
        unset($this->terrestres[$index]);
        $this->terrestres = array_values($this->terrestres);
    }
}
