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
            $table->string('airline');
			$table->integer('avail_seat_km_per_week');
			$table->integer('incidents_85_99');
			$table->integer('fatal_accidents_85_99');
			$table->integer('fatalities_85_99');
			$table->integer('incidents_00_14');
			$table->integer('fatal_accidents_00_14');
			$table->integer('fatalities_00_14');
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
