<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = '_documentos';
    protected $fillable = [
        'descripcion_doc', 'url_diagnostico', 'id_consulta'
    ];
    protected $primaryKey = 'id_docum';
}
