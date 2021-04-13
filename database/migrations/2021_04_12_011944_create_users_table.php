<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->integer('codigo');
            $table->enum('fullacces',['yes', 'no'])->nullable();
            $table->integer('numero_identificacion');
            $table->string('password');
            $table->unsignedInteger("programa_id");
            $table->unsignedInteger("rol_id");
            $table->foreign("rol_id")->references("id")->on("roles")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("programa_id")->references("id")->on("programas")
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
        Schema::dropIfExists('users');
    }
}
