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
            'model' => 'App\User',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'roles',
            'description' => 'Cadastro de Papéis',
            'model' => 'App\Role',
            'created_at' => Carbon::now(),
        ]);
        DB::table('modules')->insert([
            'prefix' => 'permissions',
            'description' => 'Cadastro de Permissões',
            'model' => 'App\Permission',
            'created_at' => Carbon::now(),
        ]);
    }
}
