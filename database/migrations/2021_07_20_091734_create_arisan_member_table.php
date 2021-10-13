<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisanMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arisan_member', function (Blueprint $table) {
            $table->string('am_id', 150)->primary()->collation('latin1_general_cs');
            $table->timestamp('am_created');
            $table->timestamp('am_updated');
            $table->string('am_arisan_id', 150)->collation('latin1_general_cs');
            $table->string('am_m_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arisan_member');
    }
}
