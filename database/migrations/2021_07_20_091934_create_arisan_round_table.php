<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisanRoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arisan_round', function (Blueprint $table) {
            $table->string('ar_id', 150)->primary()->collation('latin1_general_cs');
            $table->smallInteger('ar_round');
            $table->string('ar_place', 100);
            $table->timestamp('ar_created');
            $table->timestamp('ar_updated');
            $table->string('ar_arisan_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arisan_round');
    }
}
