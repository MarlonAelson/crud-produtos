<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros_empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('forma_envio_email', 120)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametros_empresas');
    }
}
