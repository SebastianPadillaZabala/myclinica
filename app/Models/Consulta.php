<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consultas';
    protected $fillable = [
        'fecha', 'hora', 'motivo', 'id_paciente', 'id_doctor'
    ];
    protected $primaryKey = 'id_con';
}
