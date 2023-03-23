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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->bigInteger('nip');
            $table->string('eselon')->nullable()->default('Non Eselon');
            $table->string('golongan');
            $table->string('jabatan')->default('pegawai');
            $table->date('tmt_capeg');
            $table->string('pendidikan_capeg');
            $table->string('pendidikan_terakhir');
            $table->date('tmt_p_terakhir')->nullable();
            $table->date('tmt_gaji_berkala')->nullable();
            $table->date('tmt_pensiun')->nullable();
            $table->string('status')->default('aktif');
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
        Schema::dropIfExists('pegawais');
    }
};
