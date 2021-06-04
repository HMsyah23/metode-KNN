@extends('adminlte::page')

@section('title', 'SPK RTLH | Akun')

@section('content_header')
    <h1>Daftar Pengguna</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-ios-people"></i> Data Pengguna Sistem</h3>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#addModal" data-backdrop="static"> <i class="ion ion-android-person-add" style="font-size: 20px;"></i> <b style="font-size: 20px;">Pengguna </b></button>
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
                            <th> Username (E-mail) </th>
                            <th> Nama </th>
                            {{-- <th> Peran </th> --}}
                            <th> Aksi </th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                          <tr>
                            <td><b>{{$loop->iteration}}</b></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            {{-- @if ($user->peran == 1)
                            <td>Administrator</td>   
                            @else 
                            <td>Staff</td>
                            @endif --}}
                            <td>
                                <a type="button" class="btn btn-sm btn-primary rounded-rounded" href="{{route('akuns.show',$user->id)}}"> <i class="fas fa-eye"></i></a>
                                <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$user->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button>


                                <div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-trash"></i> Yakin menghapus Data ? </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                          <form action="{{ route('akuns.destroy',$user->id) }}" method="POST">
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
                  <form role="form"  action="{{ route('akuns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title" id="exampleModalLabel"> <i class="ion ion-android-person-add"></i> Tambah Pengguna </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                              <label for="name">Nama</label>
                              <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama">
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan Email">
                              </div> 
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="peran">Peran</label>
                                  <select name="peran" class="form-control custom-select">
                                    <option value="1">Administrator</option>
                                    <option value="2">Staf</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                                <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="customFile">Foto</label> <br>
                                <img id='img-upload' class="img-fluid img-thumbnail mb-1" src="{{asset('image/user-dummy.png')}}" alt="" style="width: 68%"><br>
                                <div class="input-group">
                                  <span class="input-group-btn">
                                      <span class="btn btn-default btn-file">
                                          Browse… <input type="file" id="imgInp" name="photo">
                                      </span>
                                  </span>
                                  <input type="text" class="form-control" readonly>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ion ion-close"></i> Tutup</button>
                      <button type="submit" class="btn btn-success ml-1"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                  </form>
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