<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones';
    protected $fillable = ['cliente_id', 'habitacion_id', 'fecha_reservacion', 'fecha_entrada', 'fecha_salida'];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'pago_id');
    }

    public function ocupacion()
    {
        return $this->hasOne(Ocupacion::class, 'ocupacion_id');
    }
}
