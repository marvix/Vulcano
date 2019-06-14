<?php

namespace App\Http\Controllers;

use DB;
use Session;

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
