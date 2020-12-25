<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function getAllData()
    {
        $data = Matkul::select('mkkurid as id','mkkurNamaResmi as name','mkkurJumlahSksKurikulum as sks')->get();
        return $this->MessageSuccess($data);
    }
}
