<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * La table d'origine stockait un idjoueur alors que l'application n'a pas
     * de comptes joueurs. On la recrée autour de la catégorie jouée et du
     * score obtenu, seules données dont l'application a besoin.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('parties');

        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete();
            $table->unsignedInteger('score');
            $table->unsignedInteger('total');
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
        Schema::dropIfExists('parties');

        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->integer('idjoueur');
            $table->integer('score');
            $table->timestamps();
        });
    }
}
