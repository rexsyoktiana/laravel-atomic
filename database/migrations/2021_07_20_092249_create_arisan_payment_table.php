<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArisanPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arisan_payment', function (Blueprint $table) {
            $table->string('ap_id', 150)->primary()->collation('latin1_general_cs');
            $table->timestamp('ap_created');
            $table->timestamp('ap_updated');
            $table->string('ap_ar_id', 150)->collation('latin1_general_cs');
            $table->string('ap_m_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arisan_payment');
    }
}
