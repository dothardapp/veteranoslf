<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = ['nombre', 'escudo', 'divicion']; // Permitir asignación masiva para estos campos

    public function representantes()
    {
        return $this->hasMany(Representante::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }

}
