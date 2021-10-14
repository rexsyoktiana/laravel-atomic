<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateKategoriStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_status', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        DB::table('kategori_status')->insert(
            [
                'nama'          => 'Aktif',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ]
        );
        DB::table('kategori_status')->insert(
            [
                'nama'          => 'Tidak Aktif',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_status');
    }
}
