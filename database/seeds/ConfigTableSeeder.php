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
            'order' => 1,
            'key' => 'footer_left',
            'slug_key' => 'footer_left',
            'value' => 'Copyright © 2019 - Todos os Direitos Reservados.',
            'type' => 'text',
            'description' => 'Texto do rodapé do lado esquerdo da página',
            'created_at' => now(),
        ]);

        Config::create([
            'order' => 2,
            'key' => 'footer_right',
            'slug_key' => 'footer_right',
            'value' => 'Desenvolvido por: <strong>Fernando Salles Claro</strong>',
            'type' => 'text',
            'description' => 'Texto do rodapé do lado direito da página',
            'created_at' => now(),
        ]);

        Config::create([
            'order' => 3,
            'key' => 'brand',
            'slug_key' => 'brand',
            'value' => 'Vulcano',
            'type' => 'text',
            'description' => 'Brand do sistema',
            'created_at' => now(),
        ]);

        Config::create([
            'order' => 4,
            'key' => 'title',
            'slug_key' => 'title',
            'value' => '[Vulcano]',
            'type' => 'text',
            'description' => 'Título que será exibido nas abas do navegador',
            'created_at' => now(),
        ]);

        Config::create([
            'order' => 5,
            'key' => 'records_by_page',
            'slug_key' => 'records_by_page',
            'value' => '10',
            'type' => 'integer',
            'dataenum' => '1,100',
            'description' => 'Nº de registros por página',
            'created_at' => now(),
        ]);
    }
}
