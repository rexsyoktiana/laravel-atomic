<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisanWinnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arisan_winner', function (Blueprint $table) {
            $table->string('aw_id', 150)->primary()->collation('latin1_general_cs');
            $table->timestamp('aw_created');
            $table->timestamp('aw_updated');
            $table->string('aw_ar_id', 150)->collation('latin1_general_cs');
            $table->string('aw_m_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arisan_winner');
    }
}
