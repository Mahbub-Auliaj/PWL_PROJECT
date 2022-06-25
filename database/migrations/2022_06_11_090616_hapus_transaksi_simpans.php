<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('transaksi_pinjam', function (Blueprint $table) {
            $table->id();
            $table->string('id_pinjaman',5)->index();
            $table->string('id_anggota',5);
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
            $table->date('tanggal_pinjam')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('tanggal_kembali');
            $table->integer('jumlah');
            $table->boolean('lunas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
