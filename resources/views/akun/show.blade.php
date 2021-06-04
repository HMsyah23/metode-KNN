@extends('adminlte::page')

@section('title', 'SPK RTLH | Detail Akun')

@section('content_header')
    <div class="d-flex">
      <a href="{{route('akuns.index')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Kembali Ke Halaman Daftar Pengguna">
        <i class="fas fa-arrow-circle-left"></i>
      </a>
      <h1>Daftar Pengguna</h1>
    </div>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-ios-people"></i> Data Pengguna Sistem</h3>

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
                       src="{{ asset('storage/' .$user->photo)  }}"
                       alt="User profile picture">
                </div>
    
                <h3 class="profile-username text-center">{{$user->name }}</h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email </b> <a class="float-right">{{$user->email }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right">{{$user->peran }}</a>
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
                <h4 class="card-title"><b>Ubah Data user</b></h4>
              </div><!-- /.card-header -->
              <form role="form"  action="{{ route('akuns.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan Nama"  name="name" value="{{ $user->name }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email (Username)</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan Email"  value="{{ $user->email }}">
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" value="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="peran">Peran</label>
                        <select name="peran" class="form-control custom-select">
                          <option
                          @if ($user->id == 1)
                            selected
                          @endif
                          value="1">Administrator</option>    
                          <option
                          @if ($user->id == 2)
                            selected
                          @endif
                          value="2">Staff</option>   
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo">Ubah Foto</label>
                    <div class="input-group">
                      <span class="input-group-btn">
                          <span class="btn btn-default btn-file">
                              Browse… <input type="file" id="imgInp" name="photo">
                          </span>
                      </span>
                      <input type="text" class="form-control" name="hidden_image" value="{{ substr($user->photo,6)}}" readonly>
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