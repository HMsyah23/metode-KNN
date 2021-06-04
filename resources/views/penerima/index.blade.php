@extends('adminlte::page')

@section('title', 'SPK RTLH | Calon Penerima')

@section('content_header')
    <h1>Daftar Calon Penerima</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-android-people"></i> Data Calon Penerima Bantuan</h3> 
            <div class="col d-flex justify-content-end">
                <a href="{{route('laporan.calonpenerima')}}" class="btn btn-primary rounded-pill mr-1"> <i class="fa fa-print" style="font-size: 20px;"></i> <b style="font-size: 20px;">Laporan </b></a>
                <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#addModal" data-backdrop="static"> <i class="ion ion-android-person-add" style="font-size: 20px;"></i> <b style="font-size: 20px;">Calon Penerima </b></button>
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
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-nowrap" id="datatable">
                        <thead class="bg-success">
                        <tr>
                            <th></th>
                            <th> No KK </th>
                            <th> Nik Kepala Keluarga </th>
                            <th> Nama Kepala Keluarga </th>
                            <th> Alamat </th>
                            <th> Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($calons as $calon)
                            <tr>
                                <td><b>{{$loop->iteration}}</b></td>
                                <td>{{$calon->no_kk}}</td>
                                <td>{{$calon->no_ktp}}</td>
                                <td>{{$calon->nama_kepala_keluarga}}</td>
                                <td>{{$calon->alamat}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$calon->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button>
                                    <a href="{{route('calonpenerimas.show',$calon->id)}}" class="btn btn-sm btn-warning rounded-rounded"> <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$calon->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button>
        
                                    <div class="modal fade" id="exampleModal-{{$calon->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                              <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-eye"></i> Detail Data Calon Penerima </h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col">
                                                        <table class="table table-sm">
                                                            <thead>
                                                              <tr>
                                                                <th scope="col">No KK</th>
                                                                <th scope="col">{{$calon->no_kk}}</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">No Ktp Kepala Keluarga</th>
                                                                <td>{{$calon->no_ktp}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Nama Kepala Keluarga</th>
                                                                <td>{{$calon->nama_kepala_keluarga}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Alamat</th>
                                                                <td colspan="2">{{$calon->alamat}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Pendapatan Kepala Keluarga Per Bulan</th>
                                                                <th scope="col">Rp. {{$calon->pendapatan}}</th>
                                                            </tr>
                                                                <tr>
                                                                <th scope="row">Jumlah Tanggungan</th>
                                                                <td>{{$calon->jumlah_tanggungan}} Orang</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Luas Tanah/Tempat Hunian</th>
                                                                <td>{{$calon->luas_tanah}} m<sup>2</sup>/orang</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-bold">Foto KTP</span><br>
                                                        <img src="{{ asset('storage/' .$calon->foto_ktp)  }}" alt="" style="width: 100%">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <h4>Keadaan Rumah</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td>Kondisi Rumah</td>
                                                                <th>Tidak Layak Huni</th>
                                                            </tr>
                                                            @foreach( json_decode($calon->kondisi_rumah) as $status)
                                                            <tr>
                                                                <td></td>
                                                                <td> <i class="fa fa-check-square" style="color:green"></i> {{$status}}</td>
                                                            </tr>
                                                            @endforeach 
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4>Foto Rumah</h4>
                                                    </div>
                                                    @foreach (json_decode($calon->foto_rumah) as $rumah)
                                                    <div class="col-lg-3">
                                                        <img src="{{ asset('storage/calonpenerimas/foto_rumah/' .$rumah)  }}" class="img-fluid rounded ml-1 mr-1 mt-1 mb-1" alt="Responsive image" style="width: 200px ">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                              <a href="{{route('laporan.calonpenerima.individu',$calon->id)}}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak</a>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
    
                                    <div class="modal fade" id="deleteModal-{{$calon->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                              <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-trash"></i> Yakin menghapus Data ? </h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <form action="{{ route('calonpenerimas.destroy',$calon->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-check"></i> Iya</button>
                                            </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="ion ion-close"></i> Tidak</button>
                                            </div>
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

            
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title" id="exampleModalLabel"> <i class="ion ion-android-person-add"></i> Tambah Calon Penerima </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="stepper1" class="bs-stepper">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#test-l-1">
                                            <button type="button" class="btn step-trigger">
                                                <span class="bs-stepper-circle"><i class="ion ion-android-person"></i></span>
                                                <span class="bs-stepper-label">Data Kepala Keluarga</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#test-l-2">
                                            <button type="button" class="btn step-trigger">
                                                <span class="bs-stepper-circle"><i class="ion ion-ios-list"></i></span>
                                                <span class="bs-stepper-label">Informasi Tambahan</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#test-l-3">
                                            <button type="button" class="btn step-trigger">
                                                <span class="bs-stepper-circle"><i class="ion ion-ios-home"></i></span>
                                                <span class="bs-stepper-label">Kondisi Rumah</span>
                                            </button>
                                        </div>
                                    </div>
                                    <form role="form"  action="{{ route('calonpenerimas.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <div class="bs-stepper-content">
                                        <div id="test-l-1" class="content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="no_kk">No KK</label>
                                                            <input type="text" name="no_kk" class="form-control" id="no_kk" placeholder="Masukkan Nomor KK">
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="no_ktp">No KTP</label>
                                                            <input type="text" name="no_ktp" class="form-control" id="no_ktp" placeholder="Masukkan Nomor KTP">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Kepala Keluarga</label>
                                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="customFile">Foto</label> <br>
                                                            <img id='img-upload' class="img-fluid img-thumbnail mb-1" src="{{asset('image/user-dummy.png')}}" alt="" style="width: 50%"><br>
                                                            <div class="input-group">
                                                              <span class="input-group-btn">
                                                                  <span class="btn btn-default btn-file">
                                                                      Browse… <input type="file" id="imgInp" name="foto_ktp">
                                                                  </span>
                                                              </span>
                                                              <input type="text" class="form-control" readonly>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="ion ion-close"></i> Tutup</button>
                                                <a class="btn btn-primary text-white" onclick="stepper1.next()"> Selanjutnya <i class="ion ion-arrow-right-c"></i> </a>
                                            </div>
                                        </div>
                                        <div id="test-l-2" class="content">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="pendapatan">Pendapatan Kepala Keluarga/Bulan</label>
                                                        <input type="text" name="pendapatan" class="form-control" id="pendapatan" placeholder="Masukkan Pendapatan">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                                                        <input type="text" name="jumlah_tanggungan" class="form-control" id="jumlah_tanggungan" placeholder="Masukkan Jumlah Tanggungan">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="luas_tanah">Luas Tanah m<sup>2</sup>/Orang</label>
                                                        <input type="text" name="luas_tanah" class="form-control" id="luas_tanah" placeholder="Masukkan Luas Tanah">
                                                    </div>
                                                </div>
                                            
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ion ion-close"></i> Tutup</button>
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-primary ml-1 text-white" onclick="stepper1.previous()"> <i class="ion ion-arrow-left-c"></i> Sebelumnya</a>
                                                    <a class="btn btn-primary ml-1 text-white" onclick="stepper1.next()">Selanjutnya <i class="ion ion-arrow-right-c"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="test-l-3" class="content">
                                            
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label><strong>Keadaan Rumah Saat Ini :</strong></label><br>
                                                        <label><input type="checkbox" name="kondisi_rumah[]" value="Tidak memiliki fasilitas kamar mandi, cuci dan kakus"> Tidak memiliki fasilitas kamar mandi, cuci dan kakus</label> <br>
                                                        <label><input type="checkbox" name="kondisi_rumah[]" value="Lantai tanah/semen dalam kondisi rusak"> Lantai tanah/semen dalam kondisi rusak</label> <br>
                                                        <label><input type="checkbox" name="kondisi_rumah[]" value="Dinding dan atap sudah rusak"> Dinding dan atap sudah rusak</label> <br>
                                                        <label><input type="checkbox" name="kondisi_rumah[]" value="Dinding dan atap dibuat dari bahan yang mudah rusak/lapuk"> Dinding dan atap dibuat dari bahan yang mudah rusak/lapuk</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="customFile">Upload Foto Kondisi Rumah</label>
                                                        <div class="input-group control-group increment" >
                                                            <input type="file" name="foto_rumah[]" class="form-control">
                                                            <div class="input-group-btn"> 
                                                              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                                            </div>
                                                          </div>
                                                          <div class="clone hide">
                                                            <div class="control-group input-group" style="margin-top:10px">
                                                              <input type="file" name="foto_rumah[]" class="form-control">
                                                              <div class="input-group-btn"> 
                                                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                </div>
                                            
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ion ion-close"></i> Tutup</button>
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-primary ml-1 text-white" onclick="stepper1.previous()"> <i class="ion ion-arrow-left-c"></i> Sebelumnya</a>
                                                    <button type="submit" class="btn btn-success ml-1"> <i class="fa fa-save"></i> Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>
  <script>

$(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      });
  
      $('.btn-file :file').on('fileselect', function(event, label) {
          
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
        
      });

      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                  $('#img-upload').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]);
          }
      }
  
      $("#imgInp").change(function(){
          readURL(this);
      }); 

    });



    var stepper1Node = document.querySelector('#stepper1')
    var stepper2Node = document.querySelector('#stepper2')
    var stepper1 = new Stepper(document.querySelector('#stepper1'),{
      linear: true,
      animation: true
    })

    stepper1Node.addEventListener('show.bs-stepper', function (event) {
      console.warn('show.bs-stepper', event)
    })
    stepper1Node.addEventListener('shown.bs-stepper', function (event) {
      console.warn('shown.bs-stepper', event)
    })

    var stepper2 = new Stepper(document.querySelector('#stepper2'), {
      linear: false,
      animation: true
    })

    stepper2Node.addEventListener('show.bs-stepper', function (event) {
      console.warn('show.bs-stepper', event)
    })
    stepper2Node.addEventListener('shown.bs-stepper', function (event) {
      console.warn('shown.bs-stepper', event)
    })


    var stepper3 = new Stepper(document.querySelector('#stepper3'), {
      animation: true
    })
    var stepper4 = new Stepper(document.querySelector('#stepper4'))
  </script>
@stop