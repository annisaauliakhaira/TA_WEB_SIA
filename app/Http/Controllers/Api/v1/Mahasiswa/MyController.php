<?php

namespace App\Http\Controllers\Api\v1\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Mahasiswa
};
use App\Http\Resources\{
    Mahasiswa\listCollection as mahasiswaCollection
};

class MyController extends Controller
{
    public function getListData()
    {
        try {
            $data = Mahasiswa::select('mahasiswa.*')->join('s_krs','s_krs.krsMhsNiu','=','mahasiswa.mhsNiu')->join('s_krs_detil','s_krs.krsId','=','s_krs_detil.krsdtKrsId')->join('s_kelas','s_krs_detil.krsdtKlsId','=','s_kelas.klsId')->join('s_matakuliah_kurikulum', 's_matakuliah_kurikulum.mkkurId', '=', 's_kelas.klsMkkurId')->whereIn('mkkurProdiKode',[83,84])->whereRaw('klsSemId in (select sempSemId from s_semester_prodi where sempIsAktif = 1)')->where('mhsNiu','<>',0)->orderby('mhsNiu','desc')->distinct()->get();
            $data = mahasiswaCollection::collection($data);
            return $this->MessageSuccess($data);
        } catch (\Exception $e) {
            return $this->MessageError($e->getMessage());
        }
    }

    public function getData($nim)
    {
        try {
            $data = Mahasiswa::find($nim);
            $data = new mahasiswaCollection($data);
            return $this->MessageSuccess($data);
        } catch (\Exception $e) {
            return $this->MessageError($e->getMessage());
        }
    }
}
