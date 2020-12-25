<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\{Dosen_Kelas,Krs_Detil, Jadwal_Ujian, Kelas};

class KelasController extends Controller
{
    public function getAllDataKelas()
    {
        $data = Kelas::select('klsId as id','klsNama as name','klsMkKurId as courses_id','klsSemId as period_id')->join('s_krs_detil', 's_kelas.klsId', '=', 's_krs_detil.krsdtKlsId')->join('s_krs', 's_krs_detil.krsdtKrsId', '=', 's_krs.krsId')->join('mahasiswa', 'mahasiswa.mhsNiu', '=', 's_krs.krsMhsNiu')->join('s_dosen_kelas', 's_kelas.klsId', '=', 's_dosen_kelas.dsnkKlsId')->join('dosen', 'dosen.dsnPegNip', '=', 's_dosen_kelas.dsnkDsnPegNip')->join('pegawai', 'pegawai.PegNip', '=', 'dosen.dsnPegNip')->whereRaw("pegawai.pegJurKode IN (37, 38) AND mhsStakmhsrKode = 'A' and mhsNiu <> 0")->orderby('s_krs.krsMhsNiu','DESC')->distinct()->limit(1000)->get();
        // $data = DB::SELECT(DB::raw("SELECT klsId as id,klsNama as name,klsMkKurId as courses_id, klsSemId as period_id FROM `s_kelas` where klsSemId > 20151 and klsId in (select dsnkKlsId from s_dosen_kelas where dsnkDsnPegNip in (select PegNip from pegawai where pegJurKode in (37,38))) and klsId in (select krsdtKlsId from s_krs_detil where krsdtKrsId in (select krsId from s_krs where krsMhsNiu in (select mhsNiu from mahasiswa where mhsStakmhsrKode = 'A' and mhsNiu <> 0 and mhsProdiKode in (83,84))))"));
        return $this->MessageSuccess($data);
    }

    public function getAllKelasDosen()
    {
        $data = Dosen_Kelas::select('dsnkKlsId as class_id', 'dsnkDsnPegNip as nipDosen')->join('dosen', 'dosen.dsnPegNip', '=', 's_dosen_kelas.dsnkDsnPegNip')->join('pegawai', 'pegawai.PegNip', '=', 'dosen.dsnPegNip')->join('s_kelas', 's_dosen_kelas.dsnkKlsId', '=', 's_kelas.klsId')->join('s_krs_detil', 's_kelas.klsId', '=', 's_krs_detil.krsdtKlsId')->join('s_krs', 's_krs_detil.krsdtKrsId', '=', 's_krs.krsId')->join('mahasiswa', 'mahasiswa.mhsNiu', '=', 's_krs.krsMhsNiu')->whereRaw("pegawai.pegJurKode IN (37, 38) AND mhsStakmhsrKode = 'A' and mhsNiu <> 0")->orderby('s_krs.krsMhsNiu','DESC')->distinct()->limit(1000)->get();
        return $this->MessageSuccess($data);
    }

    public function getAllKrsMahasiswa()
    {
        $data = Krs_Detil::select('s_krs.krsMhsNiu as mahasiswaNim', 's_krs_detil.krsdtKlsId as class_id')->join('s_krs','s_krs.krsId','=','s_krs_detil.krsdtKrsId')->join('mahasiswa', 'mahasiswa.mhsNiu', '=', 's_krs.krsMhsNiu')->join('s_kelas', 's_krs_detil.krsdtKlsId', '=', 's_kelas.klsId')->join('s_dosen_kelas', 's_kelas.klsId', '=', 's_dosen_kelas.dsnkKlsId')->join('dosen', 'dosen.dsnPegNip', '=', 's_dosen_kelas.dsnkDsnPegNip')->join('pegawai', 'pegawai.PegNip', '=', 'dosen.dsnPegNip')->whereRaw("pegawai.pegJurKode IN (37, 38) AND mhsStakmhsrKode = 'A' and mhsNiu <> 0")->orderby('s_krs.krsMhsNiu','DESC')->distinct()->limit(2000)->get();
        // $data = Krs_Detil::select('s_krs.krsMhsNiu as mahasiswaNim', 's_krs_detil.krsdtKlsId as class_id')->join('s_krs','s_krs.krsId','=','s_krs_detil.krsdtKrsId')->whereRaw("s_krs_detil.krsdtKlsId in (SELECT klsId FROM `s_kelas` where klsSemId > 20151 and klsId in (select dsnkKlsId from s_dosen_kelas where dsnkDsnPegNip in (select PegNip from pegawai where pegJurKode in (37,38))) and klsId in (select krsdtKlsId from s_krs_detil where krsdtKrsId in (select krsId from s_krs where krsMhsNiu in (select mhsNiu from mahasiswa where mhsStakmhsrKode = 'A' and mhsNiu <> 0 and mhsProdiKode in (83,84)))))")->orderby('krsMhsNiu','desc')->distinct()->limit(2000)->get();
        return $this->MessageSuccess($data);
    }

    public function jadwalUjian()
    {
        $data = Jadwal_Ujian::select('jdujiId as id', 'jdujiKlsId as class_id','jdujiTanggal as tanggal','jdujiJamMulai as mulai','jdujiJamSelesai as selesai', 'jdujiJenis as examtype','pesertaujiRuId as room_id')->leftjoin('s_peserta_ujian','s_peserta_ujian.pesertaujiJdujiId','=','s_jadwal_ujian.jdujiId')->join('s_kelas', 's_jadwal_ujian.jdujiKlsId', '=', 's_kelas.klsId')->join('s_krs_detil', 's_kelas.klsId', '=', 's_krs_detil.krsdtKlsId')->join('s_krs', 's_krs_detil.krsdtKrsId', '=', 's_krs.krsId')->join('mahasiswa', 'mahasiswa.mhsNiu', '=', 's_krs.krsMhsNiu')->join('s_dosen_kelas', 's_kelas.klsId', '=', 's_dosen_kelas.dsnkKlsId')->join('dosen', 'dosen.dsnPegNip', '=', 's_dosen_kelas.dsnkDsnPegNip')->join('pegawai', 'pegawai.PegNip', '=', 'dosen.dsnPegNip')->whereNotNull('pesertaujiRuId')->where('jdujiJenis','<>','')->orderby('pesertaujiMhsNiu','desc')->distinct()->limit(500)->get();
        return $this->MessageSuccess($data);
    }

    public function jadwalUjianMahasiswa()
    {
        $data = Jadwal_Ujian::select('jdujiId as jadwal_id', 'jdujiKlsId as class_id', 'jdujiJenis as examtype','pesertaujiMhsNiu as mahasiswaNim')->leftjoin('s_peserta_ujian','s_peserta_ujian.pesertaujiJdujiId','=','s_jadwal_ujian.jdujiId')->join('s_kelas', 's_jadwal_ujian.jdujiKlsId', '=', 's_kelas.klsId')->join('s_krs_detil', 's_kelas.klsId', '=', 's_krs_detil.krsdtKlsId')->join('s_krs', 's_krs_detil.krsdtKrsId', '=', 's_krs.krsId')->join('mahasiswa', 'mahasiswa.mhsNiu', '=', 's_krs.krsMhsNiu')->join('s_dosen_kelas', 's_kelas.klsId', '=', 's_dosen_kelas.dsnkKlsId')->join('dosen', 'dosen.dsnPegNip', '=', 's_dosen_kelas.dsnkDsnPegNip')->join('pegawai', 'pegawai.PegNip', '=', 'dosen.dsnPegNip')->whereNotNull('pesertaujiRuId')->orderby('pesertaujiMhsNiu','desc')->distinct()->limit(2500)->get();
        return $this->MessageSuccess($data);
    }
}
