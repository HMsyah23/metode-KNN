@extends('adminlte::page')

@section('title', 'Pisang Krispi Rendi')

@section('content_header')
    <h1>Hasil Pengujian Algoritma K-NN</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-android-people"></i> Hasil Pengujian Algoritma K-NN</h3> 
            <div class="col d-flex justify-content-end">
                <a class="btn btn-primary rounded-pill" href="{{route('dataTestings.index')}}"> <i class="fas fa-arrow-left" style="font-size: 20px;"></i> <b style="font-size: 20px;">Kembali </b></a>
                {{-- <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#addModal" data-backdrop="static"> <i class="fas fa-upload" style="font-size: 20px;"></i> <b style="font-size: 20px;">Upload Laporan </b></button> --}}
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
        <div class="row mt-1">
            <div class="col-lg-6">
                <div class="table-responsive">
                    <span>Data Yang Telah Diolah</span>
                    <table class="table table-sm table-hover table-bordered text-nowrap" id="datatable">
                        <thead class="bg-success">
                        <tr>
                            <th></th>
                            <th> Tanggal </th>
                            <th> Hari </th>
                            <th> Cuaca </th>
                            <th> Terjual </th>
                            <th> Ranking </th>
                            <th> ED({{$dataED['tanggal']}},{{$dataED['hari']}},{{$dataED['cuaca']}}) </th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataS as $d)
                            <tr>
                                <td><b>{{$loop->iteration}}</b></td>
                                <td>{{$d['tanggal']}}</td>
                                <td>{{$d['hari']}}</td>
                                <td>{{$d['cuaca']}}</td>
                                <td>{{$d['terjual']}}</td>
                                <td>{{$d['ranking']}}</td>
                                <td>{{number_format($d['ed'],2)}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-6">
              <div class="table-responsive">
                <span>Data Testing</span>
                  <table class="table table-sm table-hover table-bordered text-nowrap" id="datatable">
                      <thead class="bg-success">
                      <tr>
                          <th> Tanggal </th>
                          <th> Hari </th>
                          <th> Cuaca </th>
                          <th> Terjual </th>
                          <th> Ranking </th>
                      </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{$dT['tanggal']}}</td>
                              <td>{{$dT['hari']}}</td>
                              <td>{{$dT['cuaca']}}</td>
                              <td>{{$dT['terjual']}}</td>
                              <td>{{$dT['ranking']}}</td>
                          </tr>
                      </tbody>
                  </table>
                  <span>Data Yang Telah Diolah</span>
                  <table class="table table-sm table-hover table-bordered text-nowrap" id="datatable">
                      <thead class="bg-success">
                      <tr>
                          <th></th>
                          <th> Tanggal </th>
                          <th> Hari </th>
                          <th> Cuaca </th>
                          <th> Terjual </th>
                          <th> Ranking </th>
                          <th> ED({{$dataED['tanggal']}},{{$dataED['hari']}},{{$dataED['cuaca']}})  </th>
                      </tr>
                      </thead>
                      <tbody>
                          @forelse ($dataS5 as $d)
                          <tr>
                              <td><b>{{$loop->iteration}}</b></td>
                              <td>{{$d['tanggal']}}</td>
                              <td>{{$d['hari']}}</td>
                              <td>{{$d['cuaca']}}</td>
                              <td>{{$d['terjual']}}</td>
                              <td>{{$d['ranking']}}</td>
                              <td>{{number_format($d['ed'],2)}}</td>
                          </tr>
                          @empty
                          @endforelse
                      </tbody>
                  </table>
                  <span>Data </span>
                  <table class="table table-sm table-hover table-bordered text-nowrap" id="datatable">
                      <thead class="bg-success">
                      <tr>
                          <th> Sedikit </th>
                          <th> Sedang </th>
                          <th> Besar </th>
                      </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{$sedikit}}</td>
                              <td>{{$sedang}}</td>
                              <td>{{$banyak}}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
    </div>
</div>
@stop

@section('css')
  {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@stop

@section('js')
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js') }}"></script>
  <script> 
      $ ( function () {
          $('#datatable').DataTable();
      })
  </script>
@stop