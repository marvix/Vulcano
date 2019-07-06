<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\User;

class AdminsWidget extends AbstractWidget
{
    protected $config = [
        'title' => 'Super Admins',
        'color' => 'blue',
        'icon' => 'person',
    ];

    public function run()
    {
        $users = User::all();
        $count = 0;
        foreach ($users as $user) {
            $roles = $user->roles;
            if($roles[0]->is_superadmin) {
                $count++;
            }
        }

        return view('widgets.infobox_widget', [
            'config' => $this->config,
            'value' => $count
        ]);
    }
}
