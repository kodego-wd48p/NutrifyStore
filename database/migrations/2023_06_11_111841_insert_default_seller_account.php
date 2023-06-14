<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Nutrify',
            'last_name' => 'Seller',
            'username' => 'nutrifyseller',
            'email' => 'nutrifyseller@gmail.com',
            'role' => 'seller',
            'password' => Hash::make('nutrifyseller'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('username', '=', 'nutrifyseller')->delete();
    }
};
