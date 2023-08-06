<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCirconstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circonstances', function (Blueprint $table) {
            $table->id();
            $table->string('country');
			$table->integer('beer_servings');
			$table->integer('spirit_servings');
			$table->integer('wine_servings');
			$table->float('total_litres_of_pure_alcohol');
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
        Schema::dropIfExists('circonstances');
    }
}
