@extends('adminlte::page')

@section('title', 'SPK RTLH | Detail Perhitungan TOPSIS')

@section('content_header')
    <h1>Ranking</h1>
@stop

@section('content')
  <div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
      <div class="row text-center">
          <h3> <i class="ion ion-stats-bars"></i> Detail Perankingan Menggunakan Metode TOPSIS</h3>
          <div class="col d-flex justify-content-end">
            <a class="btn btn-success rounded-pill text-white"  href="{{route('ranking')}}"> <i class="fas fa-arrow-left" style="font-size: 20px;"></i> <b style="font-size: 20px;">Kembali </b></a>
        </div>
      </div>

      @php
        $param1 = 0;    
                  $param2 = 0;    
                  $param3 = 0;    
                  $param4 = 0; 
          $items = array();
                  $items2 = array();
                  $items3 = array();
                  $items4 = array();
            $result = array();
          @endphp
              @foreach ($calons as $calon)
              @php
                $param1 = ($calon[0]->subkriteria->nilai * $calon[0]->subkriteria->nilai) + $param1;
                $param2 = ($calon[1]->subkriteria->nilai * $calon[1]->subkriteria->nilai) + $param2;
                $param3 = ($calon[2]->subkriteria->nilai * $calon[2]->subkriteria->nilai) + $param3;
                $param4 = ($calon[3]->subkriteria->nilai * $calon[3]->subkriteria->nilai) + $param4;
              @endphp
            @endforeach
                  @foreach ($calons as $calon)
                    @php
                     $items[] = round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4);
                    $items2[] = round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4);
                    $items3[] = round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4);
                    $items4[] = round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4);
                    @endphp
                  @endforeach
          
                @foreach ($calons as $calon)
                @if ($calon[0]->subkriteria->kriteria->tipe == "benefit")
                  @php $max = max($items)  @endphp
                  @else
                  @php $max = min($items)  @endphp
                  @endif

                  @if ($calon[1]->subkriteria->kriteria->tipe == "benefit")
                  @php $max2 = max($items2)  @endphp
                  @else
                  @php $max2 = min($items2)  @endphp
                  @endif

                  @if ($calon[2]->subkriteria->kriteria->tipe == "benefit")
                  @php $max3 = max($items3)  @endphp
                  @else
                  @php $max3 = min($items3)  @endphp
                  @endif

                  @if ($calon[3]->subkriteria->kriteria->tipe == "benefit")
                  @php $max4 = max($items4)  @endphp
                  @else
                  @php $max4 = min($items4)  @endphp
                  @endif
                  @if ($calon[0]->subkriteria->kriteria->tipe == "benefit")
                  @php $min = min($items)  @endphp
                  @else
                  @php $min = max($items)  @endphp
                  @endif

                  @if ($calon[1]->subkriteria->kriteria->tipe == "benefit")
                  @php $min2 = min($items2)  @endphp
                  @else
                  @php $min2 = max($items2)  @endphp
                  @endif

                  @if ($calon[2]->subkriteria->kriteria->tipe == "benefit")
                  @php $min3 = min($items3)  @endphp
                  @else
                  @php $min3 = max($items3)  @endphp
                  @endif

                  @if ($calon[3]->subkriteria->kriteria->tipe == "benefit")
                  @php $min4 = min($items4)  @endphp
                  @else
                  @php $min4 = max($items4)  @endphp
                  @endif
                  @php
                     $idealPositif = round(sqrt((pow($max-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($max2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($max3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($max4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                    $idealNegatif = round(sqrt((pow($min-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($min2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($min3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($min4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                    $preferensi = $idealNegatif / ($idealNegatif + $idealPositif);
                    array_push($result, array("no_kk" => $calon[0]->calonPenerima->no_kk,"nama" => $calon[0]->calonPenerima->nama_kepala_keluarga,"alamat" => $calon[0]->calonPenerima->alamat,"vi" => $preferensi))
                  @endphp
                @endforeach
          @php
            $result = collect($result)->sortBy('vi')->reverse()->toArray();  
          @endphp
      <div class="row mt-5">
        <div class="col-lg-12">
          <label class="h4">Detail</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;"> Nomor <br> Kartu Keluarga </th>
                  <th colspan="5"> Kriteria </th>
                </tr>
                <tr>
                  <th>Pendapatan Kepala Keluarga Per Bulan</th>
                  <th>Jumlah Tanggungan</th>
                  <th>Luas Tanah/Lahan Tempat Huni</th>
                  <th>Kondisi Rumah</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  <td>Rp. {{$calon[0]->calonPenerima->pendapatan}}</td>
                  <td>{{$calon[0]->calonPenerima->jumlah_tanggungan}} Orang</td>
                  <td>{{$calon[0]->calonPenerima->luas_tanah}} M<sup>2</sup>/Orang</td>
                  <td>{{$calon[3]->subkriteria->kondisi}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <label class="h4">Step 1: Matriks Keputusan (X)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;"> Nomor <br> Kartu Keluarga </th>
                  <th colspan="5"> Kriteria </th>
                </tr>
                <tr>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  <td>{{$calon[0]->subkriteria->nilai}}</td>
                  <td>{{$calon[1]->subkriteria->nilai}}</td>
                  <td>{{$calon[2]->subkriteria->nilai}}</td>
                  <td>{{$calon[3]->subkriteria->nilai}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 2: Bobot Preferensi (W)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th> Kriteria </th>
                  <th> Nama </th>
                  <th> Tipe </th>
                  <th> Bobot </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kriterias as $kriteria)
                  <tr>
                    <td>{{$kriteria->kode}}</td>
                    <td>{{$kriteria->nama}}</td>
                    <td>{{$kriteria->tipe}}</td>
                    <td>{{$kriteria->bobot}}</td>
                  </tr>  
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 3: Matriks Ternormalisasi (R)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;"> Nomor <br> Kartu Keluarga </th>
                  <th colspan="5"> Kriteria </th>
                </tr>
                <tr>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  <td>{{round(($calon[0]->subkriteria->nilai / sqrt($param1)),4)}}</td>
                  <td>{{round(($calon[1]->subkriteria->nilai / sqrt($param2)),4)}}</td>
                  <td>{{round(($calon[2]->subkriteria->nilai / sqrt($param3)),4)}}</td>
                  <td>{{round(($calon[3]->subkriteria->nilai / sqrt($param4)),4)}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 4: Matriks Normalisasi Terbobot (Y)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;"> Nomor <br> Kartu Keluarga </th>
                  <th colspan="5"> Kriteria </th>
                </tr>
                <tr>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  <td>{{round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)}}</td>
                  <td>{{round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)}}</td>
                  <td>{{round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)}}</td>
                  <td>{{round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 5: Solusi Ideal Positif (A<sup>+</sup>) & Solusi Ideal Negatif (A<sup>-</sup>)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th></th>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><b>A<sup>+</sup></b></td>
                  <td>{{max($items)}}</td>
                  <td>{{max($items2)}}</td>
                  <td>{{max($items3)}}</td>
                  <td>{{max($items4)}}</td>
                </tr>
                <tr>
                  <td><b>A<sup>-</sup></b></td>
                  <td>{{min($items)}}</td>
                  <td>{{min($items2)}}</td>
                  <td>{{min($items3)}}</td>
                  <td>{{min($items4)}}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <label class="h4">Step 6.1: Jarak Ideal Positif (S<sub>i</sub>+)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th>No. KK</th>
                  <th>Jarak Ideal Positif</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  @if ($calon[0]->subkriteria->kriteria->tipe == "benefit")
                  @php $max = max($items)  @endphp
                  @else
                  @php $max = min($items)  @endphp
                  @endif

                  @if ($calon[1]->subkriteria->kriteria->tipe == "benefit")
                  @php $max2 = max($items2)  @endphp
                  @else
                  @php $max2 = min($items2)  @endphp
                  @endif

                  @if ($calon[2]->subkriteria->kriteria->tipe == "benefit")
                  @php $max3 = max($items3)  @endphp
                  @else
                  @php $max3 = min($items3)  @endphp
                  @endif

                  @if ($calon[3]->subkriteria->kriteria->tipe == "benefit")
                  @php $max4 = max($items4)  @endphp
                  @else
                  @php $max4 = min($items4)  @endphp
                  @endif
                  @php
                    $idealPositif = round(sqrt((pow($max-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($max2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($max3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($max4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                  @endphp
                  <td>{{$idealPositif}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 6.2: Jarak Ideal Negatif (S<sub>i</sub>-)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th>No. KK</th>
                  <th>Jarak Ideal Negatif</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  @if ($calon[0]->subkriteria->kriteria->tipe == "benefit")
                  @php $min = min($items)  @endphp
                  @else
                  @php $min = max($items)  @endphp
                  @endif

                  @if ($calon[1]->subkriteria->kriteria->tipe == "benefit")
                  @php $min2 = min($items2)  @endphp
                  @else
                  @php $min2 = max($items2)  @endphp
                  @endif

                  @if ($calon[2]->subkriteria->kriteria->tipe == "benefit")
                  @php $min3 = min($items3)  @endphp
                  @else
                  @php $min3 = max($items3)  @endphp
                  @endif

                  @if ($calon[3]->subkriteria->kriteria->tipe == "benefit")
                  @php $min4 = min($items4)  @endphp
                  @else
                  @php $min4 = max($items4)  @endphp
                  @endif
                  @php
                    $idealNegatif = round(sqrt((pow($min-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($min2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($min3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($min4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                  @endphp
                  <td>{{$idealNegatif}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 7: Nilai Preferensi (V)</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th>No. KK</th>
                  <th>Nilai Preferensi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($calons as $calon)
                <tr>
                  <td><b>{{$calon[0]->calonPenerima->no_kk}}</b></td>
                  @php
                    $idealPositif = round(sqrt((pow($max-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($max2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($max3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($max4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                    $idealNegatif = round(sqrt((pow($min-(round(($calon[0]->subkriteria->nilai / sqrt($param1)) * $kriterias[0]->bobot,4)),2) 
                                      + pow($min2-(round(($calon[1]->subkriteria->nilai / sqrt($param2)) * $kriterias[1]->bobot,4)),2)
                                      + pow($min3-(round(($calon[2]->subkriteria->nilai / sqrt($param3)) * $kriterias[2]->bobot,4)),2)
                                      + pow($min4-(round(($calon[3]->subkriteria->nilai / sqrt($param4)) * $kriterias[3]->bobot,4)),2))),4);
                    $preferensi = $idealNegatif / ($idealNegatif + $idealPositif);
                  @endphp
                  <td>{{round($preferensi,4)}}</td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <label class="h4">Step 8: Perangkingan</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th>No. KK</th>
                  <th>Nama Kepala Keluarga</th>
                  <th>Preferensi</th>
                  <th>Ranking</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($result as $item)
                <tr>
                  <td><b>{{$item['no_kk']}}</b></td>
                  <td>{{$item['nama']}}</td>
                  <td>{{round($item['vi'],4)}}</td>
                  <td>{{$loop->iteration}}</td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop