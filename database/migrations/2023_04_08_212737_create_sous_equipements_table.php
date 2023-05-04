<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */ 
    public function up()
    {
        Schema::create('sous_equipements', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('identifiant')->unique();
            $table->string('designation');
            $table->string('date_achat');
            $table->string('date_arrive');
            $table->unsignedBigInteger('equipement_id');

               // Ajouter la contrainte de clé étrangère après avoir créé la colonne `equipement_id`
            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');

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
        Schema::dropIfExists('sous_equipements');
    }
}
