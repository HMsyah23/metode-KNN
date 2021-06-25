<?php

namespace App\Http\Controllers;

use App\DataTesting,App\DataTraining,App\DataSementara,App\Barang,App\Imports\DataTrainingsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DataTestingController extends Controller
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
        if ((intval(\Carbon\Carbon::parse($d)->format('d')) >= 1) && (intval(\Carbon\Carbon::parse($d)->format('d')) <= 10)) {
            return 1;
        }
        else if ((intval(\Carbon\Carbon::parse($d)->format('d')) >= 11) && (intval(\Carbon\Carbon::parse($d)->format('d')) <= 20)) {
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
                 'tanggal' => $collect->tanggal,
                 'hari' => $collect->hari,
                 'cuaca' => $collect->cuaca,
                 'terjual' => $collect->terjual,
                 'ranking' => $this->ranking($collect->terjual),
                 'ed' => 
                 sqrt(
                     pow(($this->tanggal($collect->tanggal)-$this->tanggal($angka['tanggal'])),2)+
                     pow(($this->hari($collect->hari)-$angka['hari']),2)+
                     pow(($this->cuaca($collect->cuaca)-$angka['cuaca']),2)),
            ];
        });
    }

    public function index()
    {
        $this->perhitungan_knn();
        $dataS = self::$dataS;
        $dataT = DataTesting::all();
        return view('dataTesting.index',compact('dataT','dataS'));
    }

    public function store(Request $r)
    {
        
        $dataTesting = DataTesting::create([
            'tanggal' => $r->input('tanggal'),
            'cuaca' => $r->input('cuaca'),
        ]);

        $dataTesting->hari = $this->hari(\Carbon\Carbon::parse($dataTesting->tanggal)->isoFormat('dddd'));

        $this->hasil_knn($dataTesting);
        $dataS = self::$dataS;
        
        
        $dataS = collect($dataS)->sortBy('ed',SORT_NUMERIC)->toArray();

        // dd($dataED);
        $dataS5 = collect($dataS)->sortBy('ed')->take(5);
        $sedikit = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedikit')->count();
        $sedang = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedang')->count();
        $banyak = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Banyak')->count();
        $dT = collect($dataS)->sortBy('ed')->take(5)->first();
        $dataTesting->update([
            'terjual' => $dT['terjual'],
        ]);

        $dataED = $dataTesting;

        $dataED->tanggal = $this->tanggal($dataED->tanggal);

        return redirect()->route('dataTestings.show',$dataTesting->id);
    }

    public function destroy($id){
        $dataTesting = DataTesting::find($id);
        DataTesting::destroy($dataTesting->id);
        return redirect()->route('dataTestings.index')->with('status', 'Data berhasil dihapus!');
    }

    public function addToTraining($id){
        $dataTesting = DataTesting::find($id);

        if ($dataTesting->cuaca == 1) {
            $cuaca = "cerah";
        } elseif($dataTesting->cuaca == 2) {
            $cuaca = "hujan"; 
        }

        DataTraining::create([
            'tanggal' => $dataTesting->tanggal,
            'hari'    => \Carbon\Carbon::parse($dataTesting->tanggal)->isoFormat('dddd'),
            'cuaca'   => $cuaca,
            'terjual' => $dataTesting->terjual,
        ]);

        DataTesting::destroy($id);

        return redirect()->route('dataTestings.index')->with('status', 'Data berhasil Dipindahkan Menjadi Data Training!');
    }

    public function show($id)
    {
        
        $dataTesting = DataTesting::find($id);

        $dataTesting->hari = $this->hari(\Carbon\Carbon::parse($dataTesting->tanggal)->isoFormat('dddd'));

        $this->hasil_knn($dataTesting);
        $dataS = self::$dataS;
        
        
        // $dataS = collect($dataS)->sortBy('ed')->toArray();
        $dataS = collect($dataS)->sortBy('ed',SORT_NUMERIC)->toArray();
        // dd($dataED);
        $dataS5 = collect($dataS)->sortBy('ed')->take(5);
        $sedikit = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedikit')->count();
        $sedang = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Sedang')->count();
        $banyak = collect($dataS)->sortBy('ed')->take(5)->where('ranking','Banyak')->count();
        $dT = collect($dataS)->sortBy('ed')->take(5)->first();

        $dataED = $dataTesting;

        $dataED->tanggal = $this->tanggal($dataED->tanggal);

        return view('dataTesting.show',compact('dataS','dataS5','dataED','dT','sedikit','sedang','banyak'));
    }
}
