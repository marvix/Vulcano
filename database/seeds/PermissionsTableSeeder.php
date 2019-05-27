<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define os papéis
        $roles = [
            'admin',
            'user'
        ];

        // Define as permissões
        $permissions = [
            // profile
            'profile_edit',

            // user model
            'user_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_active',

            // menu admin
            'menu_admin',
            'menu_users',
            'menu_roles',
            'menu_permissions',
            'menu_logs',
            'menu_logviewer',
            'menu_telescope'
        ];

        // Cria os papéis
        $this->command->info('Criando os papéis...');
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Cria as permissões
        $this->command->info('Criando as permissões...');
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Atribui as permissões aos papéis
        $this->command->info('Atribuindo as permissões aos papéis...');

        // Usuário admin
        Role::find(1)->givePermissionTo(
            [
                // profile
                'profile_edit',

                // user model
                'user_access',
                'user_create',
                'user_edit',
                'user_show',
                'user_delete',
                'user_active',

                // menu admin
                'menu_admin',
                'menu_users',
                'menu_roles',
                'menu_permissions',
                'menu_logs',
                'menu_logviewer',
                'menu_telescope'
            ]
        );
        // Usuário user
        Role::find(2)->givePermissionTo(
            [
                // profile
                'profile_edit',
            ]
        );

        // Atribuindo os papéis aos usuários
        $this->command->info('Atribuindo os papéis aos usuários...');
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('user');
    }
}
