<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id('id_penggajian');
            $table->string('NIK');
            $table->double('uang_makan');
            $table->double('uang_lembur');
            $table->integer('hari_kerja');
            $table->date('tanggal_penggajian'); 
            $table->string('bulan_gaji'); 
            $table->string('komponen')->nullable(); 
            $table->string('keterangan')->nullable(); 
            $table->double('total_gaji');  

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
        Schema::dropIfExists('penggajian');
    }
}
