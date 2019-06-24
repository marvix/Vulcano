<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Spatie\Permission\Models\Permission;

class PermissionsWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Permissões',
        'color' => 'yellow',
        'icon' => 'filing',
    ];

    public function run()
    {
        $permissions = Permission::count();

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $permissions
        ]);
    }
}
