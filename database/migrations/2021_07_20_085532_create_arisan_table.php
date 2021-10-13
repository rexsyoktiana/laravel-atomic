<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arisan', function (Blueprint $table) {
            $table->string('arisan_id', 150)->primary()->collation('latin1_general_cs');
            $table->string('arisan_name', 100);
            $table->tinyInteger('arisan_shake', false, false);
            $table->integer('arisan_price', false, false);
            $table->string('arisan_status', 25);
            $table->timestamp('arisan_created');
            $table->timestamp('arisan_updated');
            $table->string('arisan_a_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arisan');
    }
}
