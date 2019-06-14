<?php

namespace App\Gates;

use Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class VulcanoGateFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        $permission = [];
        if (isset($item['can'])) {
            $permissions = explode(',', $item['can']);
        }

        if (isset($item['can'])) {
            if (Auth::user()->hasPermission($permissions)) {
                return $item;
            } else {
                return false;
            }
        }

        return $item;
    }
}
