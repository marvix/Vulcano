<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Module;

class ModulesWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Módulos',
        'color' => 'yellow',
        'icon' => 'book',
    ];

    public function run()
    {
        $modules = Module::count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $modules
        ]);
    }
}
