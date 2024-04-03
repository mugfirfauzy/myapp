<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@myapp.com',
            'password' => Hash::make('password'),
            'phone' => '089517721816',
            'roles' => 'ADMIN'
        ]);
        User::factory(14)->create();
    }
}
