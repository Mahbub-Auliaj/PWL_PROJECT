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
        Schema::create('transaksi_simpan', function (Blueprint $table) {
            $table->id();
            $table->string('id_simpanan',5)->index();
            $table->string('id_anggota',5);
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
            $table->date('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('jumlah');
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
        Schema::dropIfExists('transaksi_simpan');
    }
};
