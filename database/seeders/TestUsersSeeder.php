<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'adminrtq123',
            ),
            array(
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'password' => 'gururtq123',
            ),
            array(
                'name' => 'Yayasan',
                'email' => 'yayasan@gmail.com',
                'password' => 'yayasanrtq123',
            ),
        );

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
