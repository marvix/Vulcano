<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Config;

class ParametersWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Parâmetros',
        'color' => 'blue',
        'icon' => 'albums',
    ];

    public function run()
    {
        $configs = Config::count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $configs
        ]);
    }
}
