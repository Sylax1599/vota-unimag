<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->integer('numero_identificacion');
            $table->integer('numero_tarjeton');
            $table->unsignedInteger("votacion_id");
            $table->unsignedInteger("organo_id");
            $table->foreign("votacion_id")->references("id")->on("votacion")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("organo_id")->references("id")->on("organos")
            ->onDelete("cascade")
            ->onUpdate("cascade");
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
        Schema::dropIfExists('candidatos');
    }
}
