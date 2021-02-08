<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function getAllData()
    {
        $data = Matkul::select('mkkurid as id','mkkurNamaResmi as name','mkkurJumlahSksKurikulum as sks')->join('s_kelas','s_kelas.klsMkkurId','=','s_matakuliah_kurikulum.mkkurId')->whereIn('mkkurProdiKode',[83,84])->whereRaw('klsSemId in (select sempSemId from s_semester_prodi where sempIsAktif = 1)')->distinct()->get();
        return $this->MessageSuccess($data);
    }
}
