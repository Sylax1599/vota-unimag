<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("candidatos_id");
            $table->unsignedInteger("users_id");
            $table->foreign("candidatos_id")->references("id")->on("candidatos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("users_id")->references("id")->on("users")
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
        Schema::dropIfExists('votos');
    }
}
