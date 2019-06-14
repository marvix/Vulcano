<?php

use App\Config;
use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Criando as configurações iniciais do sistema...');
        Config::create([
            'key' => 'footer_left',
            'slug_key' => 'footer_left',
            'value' => 'Copyright © 2019 - Todos os Direitos Reservados.',
            'type' => 'string',
            'description' => 'Texto do rodapé do lado esquerdo da página',
            'created_at' => now(),
        ]);

        Config::create([
            'key' => 'footer_right',
            'slug_key' => 'footer_right',
            'value' => 'Desenvolvido por: <strong>Fernando Salles Claro</strong>',
            'type' => 'string',
            'description' => 'Texto do rodapé do lado direito da página',
            'created_at' => now(),
        ]);

        Config::create([
            'key' => 'brand',
            'slug_key' => 'brand',
            'value' => 'Vulcano',
            'type' => 'string',
            'description' => 'Brand do sistema',
            'created_at' => now(),
        ]);

        Config::create([
            'key' => 'title',
            'slug_key' => 'title',
            'value' => '[Vulcano]',
            'type' => 'string',
            'description' => 'Título que será exibido nas abas do navegador',
            'created_at' => now(),
        ]);

        Config::create([
            'key' => 'records_by_page',
            'slug_key' => 'records_by_page',
            'value' => '10',
            'type' => 'integer',
            'description' => 'Nº de registros por página',
            'created_at' => now(),
        ]);
    }
}
