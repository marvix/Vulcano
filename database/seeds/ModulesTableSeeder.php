<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'prefix' => 'users',
            'description' => 'Cadastro de Usuários',
            'access' => 'CRUD',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'roles',
            'description' => 'Cadastro de Papéis',
            'access' => 'CRUD',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'permissions',
            'description' => 'Cadastro de Permissões',
            'access' => 'CRUD',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'log',
            'description' => 'Log do Sistema',
            'access' => 'R',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'profile',
            'description' => 'Perfil do Usuário',
            'access' => 'U',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'config',
            'description' => 'Configuração do Sistema',
            'access' => 'RU',
            'created_at' => Carbon::now(),
        ]);
    }
}
