<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Gedung, Ruangan};

class BuildingController extends Controller
{
    public function getAllDataGedung()
    {
        $data = Gedung::select('gdid as id','gdNama as name')->get();
        return $this->MessageSuccess($data);
    }

    public function getAllDataRuangan()
    {
        $data = Ruangan::select('ruid as id','ruKode as name','ruGdId as building_id')->get();
        return $this->MessageSuccess($data);
    }
}
