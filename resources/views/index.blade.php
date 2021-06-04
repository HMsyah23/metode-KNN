@extends('adminlte::page')

@section('title', 'SPK Renovasi Rumah Tidak Layak Huni')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="row text-center">
        <div class="col">
            <img src="{{asset('image/Logo.png')}}" alt="" style="width:15%;">
            <h1>Selamat Datang </h1>
            <h5>Sistem Analisas Penjualan Pisang Krispi Rendi</h5>
            <span>Menggunakan Metode KNN K-Nearest Neighbour </span>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$calon ?? ''}}</h3>

              <p>Data Training</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="{{route('datatrainings.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$kriteria ?? ''}}</h3>

              <p>Kriteria Penerima Bantuan</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
            <a href="{{route('kriterias.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>Ranking</h3>
  
                <p>Penerima Bantuan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('ranking')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>Data</h3>

              <p>Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('akuns.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        <!-- ./col -->
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