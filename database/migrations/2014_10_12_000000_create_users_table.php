<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use illuminate\Support\Facades\DB;
// use DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username');
            $table->string('password');
            $table->string('level');
            $table->timestamps();
        });

        DB::table('user')->insert([
            'username' => 'Administrator',
            'password' => bcrypt('admin'),
            'level' => 'admin',
        ]);

        DB::table('user')->insert([
            'username' => 'User',
            'password' => bcrypt('user'),
            'level' => 'user',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
