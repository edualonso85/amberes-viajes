<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class UsuariosCrud extends Component
{
    public $usuarios;
    public $nombre;
    public $email;
    public $telefono;
    public $role;
    public $password;
    public $user_id;
    public $modal = false;
    public $modoEdicion = false;

    protected $rules = [
        'nombre' => 'required',
        'email' => 'required|email',
        'telefono' => 'nullable',
        'role' => 'required|in:admin,vendedor',
        'password' => 'nullable|min:6',
    ];

    public function mount()
    {
        $this->modal = false;
    }

    public function render()
    {
        $this->usuarios = User::orderBy('id', 'desc')->get();
        return view('livewire.usuarios-crud');
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombre', 'email', 'telefono', 'role', 'password', 'user_id', 'modoEdicion']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->nombre = $user->name;
        $this->email = $user->email;
        $this->telefono = $user->telefono;
        $this->role = $user->role;
        $this->modoEdicion = true;
        $this->modal = true;
    }

    public function guardarUsuario()
    {
        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'email.unique' => 'El email ya está en uso.',
            'role.required' => 'El rol es obligatorio.',
            'role.in' => 'El rol seleccionado no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
        if ($this->modoEdicion && $this->user_id) {
            $this->validate([
                'nombre' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->user_id,
                'telefono' => 'nullable',
                'role' => 'required|in:admin,vendedor',
                'password' => 'nullable|min:6',
            ], $mensajes);
        } else {
            $this->validate([
                'nombre' => 'required',
                'email' => 'required|email|unique:users,email',
                'telefono' => 'nullable',
                'role' => 'required|in:admin,vendedor',
                'password' => 'required|min:6',
            ], $mensajes);
        }
        if ($this->modoEdicion && $this->user_id) {
            $user = User::find($this->user_id);
            $user->name = $this->nombre;
            $user->email = $this->email;
            $user->telefono = $this->telefono;
            $user->role = $this->role;
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->save();
        } else {
            $user = new User();
            $user->name = $this->nombre;
            $user->email = $this->email;
            $user->telefono = $this->telefono;
            $user->role = $this->role;
            $user->password = Hash::make($this->password);
            $user->save();
        }
        $this->cerrarModal();
        LivewireAlert::title('Usuario guardado')
            ->text('El usuario ha sido guardado correctamente.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function eliminarUsuario($id = null)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }
        User::find($id)?->delete();
        LivewireAlert::title('Usuario eliminado')
            ->text('El usuario ha sido eliminado correctamente.')
            ->toast()
            ->timer(2000)
            ->success()
            ->show();
    }

    public function cerrarModal()
    {
        $this->modal = false;
        $this->reset(['nombre', 'email', 'telefono', 'role', 'password', 'user_id', 'modoEdicion']);
    }

    public function confirmarEliminar($id)
    {
        LivewireAlert::title('¿Estás seguro?')
            ->text('¿Quieres eliminar este usuario?')
            ->asConfirm()
            ->onConfirm('eliminarUsuario', ['id' => $id])
            ->show();
    }
}
