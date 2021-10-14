<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_status', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        DB::table('transaksi_status')->insert(
            [
                'nama'          => 'Masuk',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ],
        );

        DB::table('transaksi_status')->insert(
            [
                'nama'          => 'Keluar',
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
        Schema::dropIfExists('transaksi_status');
    }
}
