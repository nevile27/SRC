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
			$table->string('avail_seat_km_per_week');
			$table->string('incidents_85_99');
			$table->string('fatal_accidents_85_99');
			$table->string('fatalities_85_99');
			$table->string('incidents_00_14');
			$table->string('fatal_accidents_00_14');
			$table->string('fatalities_00_14');
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
