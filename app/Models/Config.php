<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'config';

    protected $fillable = [
        'folio',
        'fechaToma',
        'fechaReporte',
        'horaToma',
        'horaReporte',
        'nombre',
        'sexo',
        'fecha',
        'pasaporte',
    ]; 

}