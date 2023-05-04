<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpreventivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mpreventives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero')->unique();
            $table->string('status');
            $table->string('umesure');
            $table->integer('idmachine');
            $table->integer('idclient');
            $table->string('intervalle');
            $table->integer('executeur'); 
            $table->date('date_prochaine');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('date_execution')->nullable();
            $table->string('etat');
            $table->date('observation')->nullable();
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
        //
    }
}
