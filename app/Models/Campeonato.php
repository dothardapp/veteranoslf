<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    protected $table = 'campeonatos'; // Especifica el nombre de la tabla si no sigue las convenciones de Laravel

    protected $fillable = [
        'nombre',
        'anio',
        'descripcion',
    ]; // Los campos que son asignables masivamente

    // Definir cualquier relación si es necesario
    // Por ejemplo, si un campeonato puede incluir varios partidos, puedes definir una relación hasMany:
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
