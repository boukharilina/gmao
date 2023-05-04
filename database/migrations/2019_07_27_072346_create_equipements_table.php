<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementsTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        //
        Schema::table('modalites', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
        
        Schema::table('equipements', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
        Schema::create('equipements', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name')->unique();
            $table->string('modele');
            $table->string('marque');
            $table->string('designation');
            $table->string('numserie')->unique();
            $table->unsignedBigInteger('modalite_id');
            $table->string('date_service');
            $table->string('plan_prev');
            $table->integer('client');
            $table->string('document'); 
        
               // Ajouter la contrainte de clé étrangère après avoir créé la colonne `modalite_id`
            $table->foreign('modalite_id')->references('id')->on('modalites')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('equipements');
    }
}
