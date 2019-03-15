<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned()->unique();
            $table->string('ID_user');
            $table->foreign('ID_user')->references('ID')->on('users');
            $table->integer('request_type')->unsigned();
            $table->foreign('request_type')->references('id')->on('request_types');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable($value = true);
            $table->json('collections')->nullable($value = true);
            $table->integer('status')->unsigned()->default(2);
            $table->foreign('status')->references('id')->on('statuses');
            $table->string('info')->nullable($value = true)->default('Esperando confirmación de correo');
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
        Schema::dropIfExists('petitions');
    }
}
