<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = ['numero', 'tipo', 'precio', 'estado', 'imagen'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }

    public function ocupaciones()
    {
        return $this->hasMany(Ocupacion::class, 'habitacion_id');
    }
}
