@extends('adminlte::page')

@section('title', 'SPK RTLH | Kriteria')

@section('content_header')
    <h1>Daftar Kriteria</h1>
@stop

@section('content')
  <div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
      <div class="row text-center">
        <h3> <i class="ion ion-ios-people"></i> Data Kriteria</h3>
        {{-- <div class="col d-flex justify-content-end">
          <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#addModal" data-backdrop="static"> <i class="ion ion-android-person-add" style="font-size: 20px;"></i> <b style="font-size: 20px;">Kriteria </b></button>
        </div> --}}
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
          @if ($errors->has('bobot'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('bobot') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-hover table-bordered text-nowrap">
              <thead class="bg-success">
                <tr>
                  <th>ID Kriteria</th>
                  <th> Nama Kriteria </th>
                  <th> Tipe </th>
                  <th> Bobot </th>
                  <th> Aksi </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kriterias as $kriteria)
                <tr>
                  <td><b>{{$kriteria->kode}}</b></td>
                  <td>{{$kriteria->nama}}</td>
                  <td>{{$kriteria->tipe}}</td>
                  <td>{{$kriteria->bobot}}</td>
                  <td>
                    <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$kriteria->kode}}" data-backdrop="static"> <i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-warning rounded-rounded" data-toggle="modal" data-target="#editModal-{{$kriteria->kode}}" data-backdrop="static"> <i class="fas fa-edit"></i></button>
                    {{-- <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal" data-backdrop="static"> <i class="fas fa-trash"></i></button> --}}
        
                    <div class="modal fade" id="exampleModal-{{$kriteria->kode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalC1Label" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalC1Label"> <i class="fa fa-eye"></i> Detail Kriteria </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row d-flex justify-content-between">
                              <div class="col-lg">
                                <label class="text-bold">Data Kriteria</label><br>
                                <table class="table table-sm">
                                  <thead>
                                    <tr>
                                      <th scope="col" class="bg-light">ID Kriteria</th>
                                      <th scope="col">{{$kriteria->kode}}</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row" class="bg-light">Nama Kriteria</th>
                                      <td>{{$kriteria->nama}}</td>
                                    </tr>
                                    <tr>
                                      <th scope="row" class="bg-light">Tipe Kriteria</th>
                                      <td>{{$kriteria->tipe}}</td>
                                    </tr>
                                    <tr>
                                      <th scope="row" class="bg-light">Bobot Kriteria</th>
                                      <td colspan="2">{{$kriteria->bobot}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                                @if ($kriteria->keterangan != Null)
                                <table class="table table-sm">
                                  <thead>
                                    <tr>
                                      <th colspan="3" class="text-center bg-primary">Keterangan</th>
                                    </tr>
                                    <tr class="bg-light">
                                      <th>#</th>
                                      <th>Kondisi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach (json_decode($kriteria->keterangan) as $keterangan)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$keterangan}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                @endif
                                <table class="table table-sm">
                                  <thead>
                                    <tr>
                                      <th colspan="3" class="text-center bg-primary">Daftar Sub Kriteria</th>
                                    </tr>
                                    <tr class="bg-light">
                                      <th>Sub Kriteria </th>
                                      @if ($kriteria->keterangan != null)
                                          <td>Keterangan</td>
                                      @endif
                                      <th>Nilai </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($kriteria->subkriterias as $subkriteria)
                                    <tr>
                                      <td>{{$subkriteria->kondisi}}</td>
                                      @if ($kriteria->keterangan != null)
                                          <td>{{$subkriteria->keterangan}}</td>
                                      @endif
                                      <td>{{$subkriteria->nilai}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            {{-- <button type="button" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak</button> --}}
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div class="modal fade" id="editModal-{{$kriteria->kode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-edit"></i> Edit Bobot Kriteria </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('kriterias.update',$kriteria->id) }}"  method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              {{-- <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Tipe Kriteria</label>
                                    <input type="text" name="tipe" class="form-control" id="exampleInputtipe1" placeholder="Masukkan Tipe" value="{{$kriteria->tipe}}">
                                  </div>
                                </div>
                              </div> --}}
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="exampleInputbobot1">Bobot Kriteria</label>
                                    <input type="text" name="bobot" class="form-control" id="exampleInputbobot1" placeholder="Masukkan Bobot" value="{{$kriteria->bobot}}">
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ion ion-close"></i> Tutup</button>
                            <button type="submit" class="btn btn-warning ml-1"> <i class="fa fa-edit"></i> Perbarui</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="ion ion-android-person-add"></i> Tambah Kriteria </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form" id="quickForm">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ID Kriteria</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan ID">
                      </div>  
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tipe Kriteria</label>
                        <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Tipe">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Urutan Kriteria</label>
                        <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Urutan">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Bobot Kriteria</label>
                        <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Bobot">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ion ion-close"></i> Tutup</button>
                <button class="btn btn-success ml-1"> <i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('vendor/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@stop

@section('js')
    <script src="{{asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.js') }}"></script>
  <script> 
      $ ( function () {
          $('#datatable').DataTable();
      })
  </script>
@stop