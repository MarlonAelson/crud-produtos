<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('identification', 255)->unique();
            $table->string('frontend');
            $table->string('type_application_navigator');
            $table->char('bd_create',1);
            $table->string('bd_database')->nullable();
            $table->string('bd_hostname')->nullable();
            $table->string('bd_username');
            $table->string('bd_password')->nullable();
            $table->string('bd_drive')->nullable();
            $table->string('bd_port')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
