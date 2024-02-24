<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'fixtures'; // Especifica el nombre de la tabla si no sigue la convención de nombres

    protected $fillable = [
        'campeonato_id',
        'cancha_id',
        'division',
        'zona',
        'fecha_num',
        'fecha',
        'hora_num',
        'equipo_local',
        'equipo_visitante',
        'goles_equipo_local',
        'goles_equipo_visitante',
    ];

    // Relaciones
    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class, 'cancha_id');
    }

    // Aquí puedes añadir otros métodos de relación o lógica del modelo según sea necesario

}
