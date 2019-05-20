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
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'),
            'active' => true,
            'super_admin' => true,
            'gender' => 'N',
            'avatar' => 'img/avatar/avatar_001.png',
            'remember_token' => str_random(10),
            'created_at' => now()
        ]);
    }
}
