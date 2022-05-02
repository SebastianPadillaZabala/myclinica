<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examenes';
    protected $fillable = [
        'nombre_examen', 'url_examen', 'id_documento', 'id_paciente'
    ];
    protected $primaryKey = 'id_exa';
}
