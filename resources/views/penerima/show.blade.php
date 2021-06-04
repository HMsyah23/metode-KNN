@extends('adminlte::page')

@section('title', 'SPK RTLH | Detail Calon Penerima')

@section('content_header')
    <div class="d-flex">
      <a href="{{route('calonpenerimas.index')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Kembali Ke Halaman Daftar Pengguna">
        <i class="fas fa-arrow-circle-left"></i>
      </a>
      <h1>Detail Calon Penerima Bantuan</h1>
    </div>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-ios-people"></i> Data Calon Penerima Bantuan</h3>

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
        <div class="row">
          <div class="col-md-2">
    
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img id='img-upload' class="profile-user-img img-fluid img-circle"
                       src="{{ asset('storage/' .$calon->foto_ktp)  }}"
                       alt="User profile picture">
                </div>
    
                <h3 class="profile-username text-center">{{$calon->name }}</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>No KK </b> <a class="float-right text-xs">{{$calon->no_kk }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>No KTP</b> <a class="float-right text-xs">{{$calon->no_ktp }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-10">
            <div class="card">
              <div class="card-header d-flex justify-content-center p-2 bg-primary">
                <h4 class="card-title"><b>Ubah Data Calon Penerima Bantuan</b></h4>
              </div><!-- /.card-header -->
              <form role="form"  action="{{ route('calonpenerimas.update',$calon->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="no_kk">No KK</label>
                                <input type="text" name="no_kk" class="form-control" id="no_kk" placeholder="Masukkan Nomor KK" value="{{$calon->no_kk}}">
                            </div> 
                            
                            <div class="form-group">
                                <label for="nama">Nama Kepala Keluarga</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{$calon->nama_kepala_keluarga}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input type="text" name="no_ktp" class="form-control" id="no_ktp" placeholder="Masukkan Nomor KTP" value="{{$calon->no_ktp}}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" value="{{$calon->alamat}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="photo">Ubah Foto</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Browse… <input type="file" id="imgInp" name="foto_ktp">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" value="{{ substr($calon->foto_ktp,15)}}" readonly>
                                </div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="pendapatan">Pendapatan Kepala Keluarga/Bulan</label>
                                <input type="text" name="pendapatan" class="form-control" id="pendapatan" placeholder="Masukkan Pendapatan" value="{{$calon->pendapatan}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                                <input type="text" name="jumlah_tanggungan" class="form-control" id="jumlah_tanggungan" placeholder="Masukkan Jumlah Tanggungan" value="{{$calon->jumlah_tanggungan}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="luas_tanah">Luas Tanah m<sup>2</sup>/Orang</label>
                                <input type="text" name="luas_tanah" class="form-control" id="luas_tanah" placeholder="Masukkan Luas Tanah" value="{{$calon->luas_tanah}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><strong>Keadaan Rumah Saat Ini :</strong></label><br>
                                @foreach( $keadaan_rumah as $status)
                                    <label class="ml-5"><input type="checkbox" name="kondisi_rumah[]" value="{{$status}}" 
                                        @if (in_array($status,json_decode($calon['kondisi_rumah'])))
                                            checked
                                        @endif
                                    > {{$status}}</label> <br>
                                @endforeach
                            </div>
                        </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="customFile">Upload Foto Kondisi Rumah</label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" name="foto_rumah[]" class="form-control">
                                        {{-- <div class="input-group-btn"> 
                                          <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div> --}}
                                      </div>
                                      <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                          <input type="file" name="foto_rumah[]" class="form-control">
                                          {{-- <div class="input-group-btn"> 
                                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                          </div> --}}
                                        </div>
                                      </div>
                                </div>
                            </div>
                            
                        </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
                <!-- /.card-body -->
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
  </script>  
@stop