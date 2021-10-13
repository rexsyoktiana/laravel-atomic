<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->string('m_id', 150)->primary()->collation('latin1_general_cs');
            $table->string('m_username', 50)->unique();
            $table->string('m_password', 150);
            $table->string('m_name', 100);
            $table->string('m_status', 25);
            $table->string('m_foto', 150)->nullable();
            $table->timestamp('m_created');
            $table->timestamp('m_updated');
            $table->string('m_a_id', 150)->collation('latin1_general_cs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
