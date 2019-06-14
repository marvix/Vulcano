<?php

use App\User;
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
        $this->command->info('Criando o usuário "Super Man"...');
        User::create([
            'name' => 'Super Man',
            'email' => 'superman@vulcano.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superman'),
            'active' => true,
            'gender' => 'N',
            'skin' => 'blue',
            'remember_token' => str_random(10),
            'created_at' => now(),
        ]);

        $this->command->info('Criando o usuário "Admin"...');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vulcano.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'),
            'active' => true,
            'gender' => 'N',
            'skin' => 'red',
            'remember_token' => str_random(10),
            'created_at' => now(),
        ]);

        $this->command->info('Criando o usuário "Usuário Normal"...');
        User::create([
            'name' => 'Usuário Normal',
            'email' => 'user@vulcano.com',
            'email_verified_at' => now(),
            'password' => bcrypt('user1234'),
            'active' => true,
            'gender' => 'N',
            'skin' => 'green',
            'remember_token' => str_random(10),
            'created_at' => now(),
        ]);
    }
}
