<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $percent = 5;
    protected $months_to_calculate = 6;

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

    public function getProyectionAttribute()
    {
        $amounts = [];
        $current_amount = $this->salarioDolares;

        $amounts[] = number_format($current_amount,2,'.',',');

        for($x = 1; $x <= $this->months_to_calculate; $x ++) {
            if ($x > 1 ){
                $amount = self::getSalaryProyectionPerMonth($current_amount);
                $amounts[] = number_format($amount,2,'.',',');
                $current_amount = $amount;
            }
        }

        return $amounts;

    }

    protected function getSalaryProyectionPerMonth($amount)
    {
        $proyection = $amount + (($amount) * ($this->percent / 100));

        return $proyection;
    }
}
