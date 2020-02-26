<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("codigo");
            $table->string("nombre");
            $table->double("salarioDolares",20,2);
            $table->double("salarioPesos",20,2);
            $table->string("direccion");
            $table->string("estado");
            $table->string("ciudad");
            $table->string("telefono");
            $table->string("correo");
            $table->char("status",1)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
