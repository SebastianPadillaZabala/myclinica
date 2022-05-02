<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspeDoc extends Model
{
    use HasFactory;

    protected $table = 'medesp';
    protected $fillable = [
        'id_especialidad', 'id_doctor'
    ];

}
