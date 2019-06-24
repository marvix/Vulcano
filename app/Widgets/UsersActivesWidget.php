<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\User;

class UsersActivesWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Ativos',
        'color' => 'yellow',
        'icon' => 'people',
    ];

    public function run()
    {
        $rows = User::where('active','1')->count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $rows
        ]);
    }
}
