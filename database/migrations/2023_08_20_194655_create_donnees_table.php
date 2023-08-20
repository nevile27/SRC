<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donnees', function (Blueprint $table) {
            $table->id();
            $table->integer('identifiant');
			$table->string('name');
			$table->string('lastname');
			$table->string('firstname');
			$table->integer('articleNum');
			$table->string('birthDate');
			$table->string('birthMonth');
			$table->string('birthDay');
			$table->string('zodiac');
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
        Schema::dropIfExists('donnees');
    }
}
