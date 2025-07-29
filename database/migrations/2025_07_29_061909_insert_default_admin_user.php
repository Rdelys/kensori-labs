<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends \Illuminate\Database\Migrations\Migration {
    public function up(): void
    {
        DB::table('admins')->insert([
            'login' => 'adminKensori',
            'password' => Hash::make('KensoriLabs'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('admins')->where('login', 'adminKensori')->delete();
    }
};

