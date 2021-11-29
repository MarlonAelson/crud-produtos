<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emitente_id')->nullable();
            $table->foreign('emitente_id')->references('id')->on('pessoas');
            $table->unsignedBigInteger('destinatario_id')->nullable();;
            $table->foreign('destinatario_id')->references('id')->on('pessoas');
            $table->integer('numero')->nullable();
            $table->char('situacao')->nullable();
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
        Schema::dropIfExists('ordens');
    }
}
