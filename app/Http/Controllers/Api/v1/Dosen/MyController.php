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
            $data = Dosen::select('dosen.*')->where('dsnPegNip','<>',0)->leftjoin('s_dosen_kelas','s_dosen_kelas.dsnkDsnPegNip','=','dosen.dsnPegNip')->leftjoin('s_kelas','s_dosen_kelas.dsnkKlsId','=','s_kelas.klsId')->leftjoin('s_matakuliah_kurikulum', 's_matakuliah_kurikulum.mkkurId', '=', 's_kelas.klsMkkurId')->whereIn('mkkurProdiKode',[83,84])->whereRaw('klsSemId in (select sempSemId from s_semester_prodi where sempIsAktif = 1)')->distinct()->get();
            $data = listCollection::collection($data);
            return $this->MessageSuccess($data);
        } catch (\Exception $e) {
            return $this->MessageError($e->getMessage());
        }
    }
}
