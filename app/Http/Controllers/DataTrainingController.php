<?php

namespace App\Http\Controllers;

use App\DataTraining;
use App\Barang;
use App\Imports\DataTrainingsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DataTrainingController extends Controller
{
    private static $dataS,$pengajar,$pengajars,$dataTrainings,$optimasi,$Yi,$hasil,$optimasi_l;

    public function ranking($d) {
        if (($d > 0) && ($d < 11)){
            return "Sedikit";
        } elseif ((($d > 10) && ($d < 21))){
            return "Sedang";
        } elseif ((($d > 20) && ($d < 31))){
            return "Banyak";
        }
    }

    public function hari($d) {
        if ($d == "Senin" || $d == "senin") {
            return 1;
        } else if ($d == "Selasa" || $d == "selasa") {
            return 2;
        } else if ($d == "Rabu" || $d == "rabu") {
            return 3;
        } else if ($d == "Kamis" || $d == "kamis") {
            return 4;
        } else if ($d == "Jumat" || $d == "jumat") {
            return 5;
        } else if ($d == "Sabtu" || $d == "sabtu") {
            return 6;
        } else if ($d == "Minggu" || $d == "minggu") {
            return 7;
        }
    }

    public function cuaca($d) {
        if ($d == "Cerah" || $d == "cerah") {
            return 1;
        } else if ($d == "Hujan" || $d == "hujan") {
            return 2;
        }
    }

    public function tanggal($d) {
        if ((intval(\Carbon\Carbon::parse($d)->format('d')) >= 1) && (intval(\Carbon\Carbon::parse($d)->format('d')) <= 11)) {
            return 1;
        }
        else if ((intval(\Carbon\Carbon::parse($d)->format('d')) >= 12) && (intval(\Carbon\Carbon::parse($d)->format('d')) <= 20)) {
            return 2;
        } else if ((intval(\Carbon\Carbon::parse($d)->format('d')) >= 21) && (intval(\Carbon\Carbon::parse($d)->format('d')) <= 32)) {
            return 3;
        }
    }

    public function perhitungan_knn(){
        self::$dataTrainings = DataTraining::all();
        $dataTraining = DataTraining::all();
        self::$dataS = collect(self::$dataTrainings)->map(function($dataTrainings, $key) use ($dataTraining) {
            $collect = (object)$dataTrainings;
            return [
                 'tanggal' => $this->tanggal($collect->tanggal),
                 'hari' => $this->hari($collect->hari),
                 'cuaca' => $this->cuaca($collect->cuaca),
                 'terjual' => $collect->terjual,
                 'ranking' => $this->ranking($collect->terjual),
            ];
        });
    }

    public function euclidean_distance($variable,$f) {
        $item = 0;
        foreach ($variable as $p) {
            $pangkat = pow($p->relasis[0]->$f->nilai, 2);
            $item = $item + $pangkat;
        }
        return sqrt($item);
    }

    public function hasil_knn($angka){
        self::$dataTrainings = DataTraining::all();
        $dataTraining = DataTraining::all();
        self::$dataS = collect(self::$dataTrainings)->map(function($dataTrainings, $key) use ($dataTraining,$angka) {
            $collect = (object)$dataTrainings;
            return [
                 'tanggal' => $this->tanggal($collect->tanggal),
                 'hari' => $this->hari($collect->hari),
                 'cuaca' => $this->cuaca($collect->cuaca),
                 'terjual' => $collect->terjual,
                 'ranking' => $this->ranking($collect->terjual),
                 'ed' => 
                 sqrt(
                     pow(($this->tanggal($collect->tanggal)-$angka['tanggal']),2)+
                     pow(($this->hari($collect->hari)-$angka['hari']),2)+
                     pow(($this->cuaca($collect->cuaca)-$this->cuaca($angka['cuaca'])),2)),
            ];
        });
    }

    public function index()
    {
        $this->perhitungan_knn();
        $dataS = self::$dataS;
        $dataT = DataTraining::all();
        return view('dataTraining.index',compact('dataT','dataS'));
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        DataTraining::truncate();
        Excel::import(new DataTrainingsImport, $r->data_training);

        return redirect()->back()->with('status', 'Data Training Berhasil Diunggah');
    }

    public function show(DataTraining $dataTraining)
    {
        //
    }

    public function edit(DataTraining $dataTraining)
    {
        //
    }

    public function update(Request $request, DataTraining $dataTraining)
    {
        //
    }

    public function destroy($id)
    {
        $dataTesting = DataTraining::find($id);
        DataTraining::destroy($dataTesting->id);
        return redirect()->route('dataTrainings.index')->with('status', 'Data berhasil dihapus!');
    }

}
