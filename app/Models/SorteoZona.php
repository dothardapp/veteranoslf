<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteoZona extends Model
{
    use HasFactory;

    protected $table = 'sorteo_zonas'; // Especifica el nombre de la tabla si no sigue la convención de Laravel

    protected $fillable = [
        'division',
        'zona',
        'campeonato_id',
        'equipo_id',
        // 'fecha', // Ya no es necesario aquí si lo vas a declarar en $dates
    ];

    // Agregar 'fecha' a la propiedad $dates
    protected $dates = ['fecha'];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
