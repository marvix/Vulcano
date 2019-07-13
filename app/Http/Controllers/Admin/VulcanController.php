<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use App\Http\Controllers\Controller;

class VulcanController extends Controller
{
    public function start()
    {
        $config = DB::table('config')->get();

        foreach ($config as $conf) {
            Session::put($conf->slug_key, $conf->value);
        }

        return view('welcome');
    }
}
