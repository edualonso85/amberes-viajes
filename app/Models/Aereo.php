<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aereo extends Model
{
    use HasFactory;
    protected $fillable = [
        'reserva_id',
        'codigo_aereo',
        'proveedor',
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'horario_salida',
        'horario_llegada',
        'monto_usd',
        'monto_pesos',
        'observaciones'
    ];
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
