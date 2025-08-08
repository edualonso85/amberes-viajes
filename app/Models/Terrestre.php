<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terrestre extends Model
{
    use HasFactory;
    protected $fillable = [
        'reserva_id',
        'proveedor',
        'descripcion_corta',
        'fecha_inicial',
        'fecha_final',
        'precio_usd',
        'precio_pesos'
    ];
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
