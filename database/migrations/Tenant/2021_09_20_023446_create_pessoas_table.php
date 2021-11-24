<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120)->nullable();
            $table->string('nome_alternativo', 120)->nullable();
            $table->char('empresa', 1)->nullable();
            $table->char('cliente', 1)->nullable();
            $table->char('fornecedor', 1)->nullable();
            $table->char('colaborador', 1)->nullable();
            $table->char('outros', 1)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->char('acessa_sistema', 1)->nullable();
            $table->char('ativo', 1)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('pessoas');
    }
}
