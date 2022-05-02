<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $fillable = [
        'nombrePac', 'CI', 'fecha_nac', 'celular', 'id_user'
    ];
    protected $primaryKey = 'id_pac';
}
