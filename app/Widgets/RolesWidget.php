<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Spatie\Permission\Models\Role;

class RolesWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Papéis',
        'color' => 'blue',
        'icon' => 'book',
    ];

    public function run()
    {
        $roles = Role::count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $roles
        ]);
    }
}
