<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'vendedor_id'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
    public function aereos()
    {
        return $this->hasMany(Aereo::class);
    }
    public function terrestres()
    {
        return $this->hasMany(Terrestre::class);
    }
}
