<?php

namespace App\Http\Controllers\Api\v1\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Http\Resources\Dosen\listCollection;

class MyController extends Controller
{
    public function getListData()
    {
        try {
            $data = Dosen::where('dsnPegNip','<>',0)->whereRaw("dsnPegNip in (select PegNip from pegawai where pegJurKode = 37)")->distinct()->get();
            $data = listCollection::collection($data);
            return $this->MessageSuccess($data);
        } catch (\Exception $e) {
            return $this->MessageError($e->getMessage());
        }
    }
}
