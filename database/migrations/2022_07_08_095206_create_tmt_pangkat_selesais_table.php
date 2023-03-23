<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('tmt_pangkat_selesais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->date('tmt_pangkat_lama');
            $table->date('tmt_pangkat_baru');
            $table->timestamp('tanggal_diproses');
            // $table->text('persyaratan')->nullable();
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
        Schema::dropIfExists('tmt_pangkat_selesais');
    }
};
