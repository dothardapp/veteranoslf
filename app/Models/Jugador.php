<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores'; // Especifica el nombre de la tabla si no sigue las convenciones de Laravel

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'foto',
        'fechanac',
        'telefono',
        'domicilio',
        'equipo_id', // Asegúrate de incluir equipo_id si quieres que sea asignable masivamente
    ]; // Los campos que son asignables masivamente

    // Definir la relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
