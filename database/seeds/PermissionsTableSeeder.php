<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            ['role' => 'Super Admin', 'description' => 'Super Administrador', 'is_superadmin' => true],
            ['role' => 'Admin', 'description' => 'Administrador', 'is_superadmin' =>  false],
            ['role' => 'User', 'description' => 'Usuário Padrão', 'is_superadmin' => false],
        ];

        // Cria os papéis
        $this->command->info('Criando os papéis...');
        foreach ($roles as $role) {
            Role::create(
                [
                    'name' => $role['role'],
                    'description' => $role['description'],
                    'is_superadmin' => $role['is_superadmin'],
                ]
            );
        }

        // Define as permissões
        $permissions = [
            // profile
            ['permission' => 'profile_edit', 'description' => 'Edição dos dados do usuário'],

            // user model
            ['permission' => 'users_access', 'description' => 'Acesso à lista de usuários'],
            ['permission' => 'users_create', 'description' => 'Permite inserir novos usuários'],
            ['permission' => 'users_edit', 'description' => 'Permite editar dados de um usuário'],
            ['permission' => 'users_show', 'description' => 'Permite ver os detalhes de um usuário'],
            ['permission' => 'users_delete', 'description' => 'Permite excluir um usuário'],
            ['permission' => 'users_active', 'description' => 'Permite ativar/desativar um usuário'],

            // menu roles
            ['permission' => 'roles_access', 'description' => 'Exibe a lista de papéis'],
            ['permission' => 'roles_create', 'description' => 'Permite criar um papel'],
            ['permission' => 'roles_edit', 'description' => 'Permite editar um papel'],
            ['permission' => 'roles_show', 'description' => 'Permite exibir detalhes de um papel'],
            ['permission' => 'roles_delete', 'description' => 'Permite excluir um papel'],

            // menu permissions
            ['permission' => 'permissions_access', 'description' => 'Exibe a lista de permissões'],
            ['permission' => 'permissions_create', 'description' => 'Permite criar uma permissão'],
            ['permission' => 'permissions_edit', 'description' => 'Permite editar uma permissão'],
            ['permission' => 'permissions_show', 'description' => 'Permite exibir detalhes de uma permissão'],
            ['permission' => 'permissions_delete', 'description' => 'Permite excluir uma permissão'],

            // menu config
            ['permission' => 'config_access', 'description' => 'Exibe a lista de configurações do sistema'],
            ['permission' => 'config_create', 'description' => 'Permite criar uma configuração'],
            ['permission' => 'config_edit', 'description' => 'Permite editar uma configuração'],
            ['permission' => 'config_show', 'description' => 'Permite exibir detalhes de uma configuração'],
            ['permission' => 'config_delete', 'description' => 'Permite excluir uma configuração'],
        ];

        // Cria as permissões
        $this->command->info('Criando as permissões...');
        foreach ($permissions as $permission) {
            Permission::create(
                [
                    'name' => $permission['permission'],
                    'description' => $permission['description'],
                ]
            );
        }

        // Atribui as permissões aos papéis
        $this->command->info('Atribuindo as permissões aos papéis...');

        // usuário admin
        Role::find(2)->givePermissionTo([
            'profile_edit',

            'users_access',
            'users_create',
            'users_edit',
            'users_show',
            'users_delete',
            'users_active',

            'roles_access',
            'roles_create',
            'roles_edit',
            'roles_show',
            'roles_delete',

            'permissions_access',
            'permissions_create',
            'permissions_edit',
            'permissions_show',
            'permissions_delete',
        ]);

        // Usuário user
        Role::find(3)->givePermissionTo([
            'profile_edit',
        ]);

        // Atribuindo os papéis aos usuários
        $this->command->info('Atribuindo os papéis aos usuários...');
        User::find(1)->assignRole('Super Admin');
        User::find(2)->assignRole('Admin');
        User::find(3)->assignRole('User');
    }
}
