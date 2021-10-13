<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('a_id', 150)->primary()->collation('latin1_general_cs');
            $table->string('a_username', 50)->unique();
            $table->string('a_password', 150);
            $table->string('a_name', 100);
            $table->string('a_status', 25);
            $table->string('a_foto', 150)->nullable();
            $table->timestamp('a_created');
            $table->timestamp('a_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
