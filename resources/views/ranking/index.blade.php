@extends('adminlte::page')

@section('title', 'SPK RTLH | Perankingan')

@section('content_header')
    <h1>Ranking</h1>
@stop

@section('content')
  <div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
      <div class="row text-center">
          <h3> <i class="ion ion-stats-bars"></i> Hasil Perankingan Menggunakan Metode TOPSIS</h3>
          <div class="col d-flex justify-content-end">
            <a href="{{route('laporan.calonpenerima')}}" class="btn btn-primary rounded-pill mr-1"> <i class="fa fa-print" style="font-size: 20px;"></i> <b style="font-size: 20px;">Laporan </b></a>
              <a class="btn btn-success rounded-pill text-white"  href="{{route('ranking.detail')}}"> <i class="fas fa-calculator" style="font-size: 20px;"></i> <b style="font-size: 20px;">Detail Perhitungan TOPSIS </b></a>
          </div>
      </div>
      <div class="row mt-1 mb-0">
        <div class="col">
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
          @if(Session::has('errors'))
          @if (is_array($errors))
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <div class="card-header">
                <h3 class="card-title"><strong>Gagal Tersimpan</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            @elseif (session('errorr'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('errorr') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
          @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          @endif
        @endif
        </div>
      </div>
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
                      $items[] = round(($calon[0]->subkriteria->nilai / $param1) * $kriterias[0]->bobot,3);
                      $items2[] = round(($calon[1]->subkriteria->nilai / $param2) * $kriterias[1]->bobot,3);
                      $items3[] = round(($calon[2]->subkriteria->nilai / $param3) * $kriterias[2]->bobot,3);
                      $items4[] = round(($calon[3]->subkriteria->nilai / $param4) * $kriterias[3]->bobot,3);
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
                       array_push($result, array("id" => $calon[0]->calonPenerima->id,"no_kk" => $calon[0]->calonPenerima->no_kk,"nama" => $calon[0]->calonPenerima->nama_kepala_keluarga,"alamat" => $calon[0]->calonPenerima->alamat,"vi" => $preferensi))
                  @endphp
                @endforeach
          @php
            $result = collect($result)->sortBy('vi')->reverse()->toArray();  
          @endphp

          <label class="h4">Daftar Prioritas</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-success">
                <tr>
                  <th></th>
                  <th>No. KK</th>
                  <th>Nama Kepala Keluarga</th>
                  <th>Alamat</th>
                  <th>Prioritas</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($result as $item)
                <tr>
                  <td><a href="{{route('laporan.calonpenerima.individu',$item['id'])}}" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a></td>
                  <td><b>{{$item['no_kk']}}</b></td>
                  <td><b>{{$item['nama']}}</b></td>
                  <td><b>{{$item['alamat']}}</b></td>
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