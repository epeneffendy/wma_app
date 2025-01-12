<?php

namespace App\Services;

use App\Models\Units;

class UnitsService
{
    public function get($request = null)
    {
        $data = Units::where(['status' => 1])->get();
        return $data;
    }
}
