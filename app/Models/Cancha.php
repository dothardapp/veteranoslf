<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    use HasFactory;

    protected $table = 'canchas'; // Especifica el nombre de la tabla si no sigue las convenciones de Laravel

    protected $fillable = [
        'nombre',
        'domicilio',
        'latitud',
        'longitud',
        'imagen',
        'descripcion',
    ]; // Los campos que son asignables masivamente

    // Definir cualquier relación si es necesario
    // Por ejemplo, si una cancha puede tener varios partidos, puedes definir una relación hasMany:
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
