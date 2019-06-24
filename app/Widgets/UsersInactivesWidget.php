<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\User;

class UsersInactivesWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Inativos',
        'color' => 'red',
        'icon' => 'people',
    ];

    public function run()
    {
        $rows = User::where('active', '0')->count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $rows
        ]);
    }
}
