<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        "codigo",
        "nombre",
        "salarioDolares",
        "salarioPesos",
        "direccion",
        "estado",
        "ciudad",
        "telefono",
        "correo"
    ];
}
