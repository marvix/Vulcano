<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\User;

class DashboardWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'color' => 'bg-yellow',
        'title' => 'Nº de Usuários',
        'icon' => 'fa fa-users',
        'route' => 'users.index'
    ];


    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $users = User::count();

        return view('widgets.dashboard_widget', [
            'config' => $this->config,
            'quantidade' => $users,
        ]);
    }
}
