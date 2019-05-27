<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cria um usuário administrador
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@vulcano.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'),
            'active' => true,
            'isAdmin' => true,
            'gender' => 'N',
            'remember_token' => str_random(10),
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Usuário Normal',
            'email' => 'user@vulcano.com',
            'email_verified_at' => now(),
            'password' => bcrypt('user1234'),
            'active' => true,
            'isAdmin' => false,
            'gender' => 'N',
            'remember_token' => str_random(10),
            'created_at' => now(),
        ]);
    }
}
