<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\User;

class UsersWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'title' => 'Usuários',
        'color' => 'green',
        'icon' => 'people',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $rows = User::count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $rows
        ]);
    }
}
