<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'login' => 'adminKensori',
            'password' => Hash::make('KensoriLabs'),
        ]);
    }
}

