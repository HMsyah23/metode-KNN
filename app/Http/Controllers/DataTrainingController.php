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
        if ($d == "Senin") {
            return 1;
        } else if ($d == "Selasa") {
            return 2;
        } else if ($d == "Rabu") {
            return 4;
        } else if ($d == "Kamis") {
            return 5;
        } else if ($d == "Jumat") {
            return 5;
        } else if ($d == "Sabtu") {
            return 6;
        } else if ($d == "Minggu") {
            return 7;
        }
    }

    public function cuaca($d) {
        if ($d == "Cerah") {
            return 1;
        } else if ($d == "Hujan") {
            return 2;
        }
    }

    public function tanggal($d) {
        if ((\Carbon\Carbon::parse($d)->format('d') > 0) && (\Carbon\Carbon::parse($d)->format('d') < 11)) {
            return 1;
        }
        else if ((\Carbon\Carbon::parse($d)->format('d') > 10) && (\Carbon\Carbon::parse($d)->format('d') < 21)) {
            return 2;
        } else if ((\Carbon\Carbon::parse($d)->format('d') > 20) && (\Carbon\Carbon::parse($d)->format('d') < 32)) {
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
                 'ed' => sqrt(pow(($this->tanggal($collect->tanggal)-$angka['tanggal']),2)+pow(($this->hari($collect->hari)-$angka['hari']),2)+pow(($this->cuaca($collect->cuaca)-$angka['cuaca']),2)),
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

        return redirect()->back()->with('success', 'All good!');
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

    public function destroy(DataTraining $dataTraining)
    {
        //
    }

    public function dataTesting(Request $r)
    {
        $this->hasil_knn($r->all());
        $dataS = self::$dataS;
        $dataED = $r->all();
        $dataS = collect($dataS)->sortBy('ed')->toArray();
        $dataS5 = collect($dataS)->sortBy('ed')->take(5);
        $sedikit = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedikit')->count();
        $sedang = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedang')->count();
        $banyak = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Banyak')->count();
        $dT = collect($dataS)->sortBy('ed')->take(5)->first();
        return view('dataTraining.ed',compact('dataS','dataS5','dataED','dT','sedikit','sedang','banyak'));

    }

}
