<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('usu_id');
            $table->string('usu_name');
            $table->string('usu_email')->unique();
            $table->timestamp('usu_email_verified_at')->nullable();
            $table->string('usu_password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('usuarios')->insert([ // 1
            'usu_id'        => '1',
            'usu_name'      => 'user1',
            'usu_email'     => 'user1@user.com',
            'usu_password'  => Hash::make('user1'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
        DB::table('usuarios')->insert([ // 2
            'usu_id'        => '2',
            'usu_name'      => 'user2',
            'usu_email'     => 'user2@user.com',
            'usu_password'  => Hash::make('user2'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
