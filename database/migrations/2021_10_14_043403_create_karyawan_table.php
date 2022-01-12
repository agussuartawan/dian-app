<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->integer('id_user')->nullable();
            $table->string('NIK');
            $table->string('nama_karyawan');
            $table->string('KTP');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['laki-laki','perempuan'] ); 
            $table->string('telephone');
            $table->double('gaji_pokok');
            $table->enum('divisi', ['admin','accounting','gudang','sales']);
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
        Schema::dropIfExists('tb_karyawan');
    }
}
