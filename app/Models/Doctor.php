<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especialidad;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctores';
    protected $fillable = [
        'nombreDoc', 'CI', 'fecha_nac', 'celular', 'id_especialidad', 'id_user'
    ];
    protected $primaryKey = 'id_doc';

    public function espe()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
