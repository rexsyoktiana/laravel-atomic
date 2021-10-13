<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin', function (Blueprint $table) {
            $table->string('sa_id', 150)->primary()->collation('latin1_general_cs');
            $table->string('sa_username', 50)->unique();
            $table->string('sa_name', 100);
            $table->timestamp('sa_created');
            $table->timestamp('sa_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_admin');
    }
}
