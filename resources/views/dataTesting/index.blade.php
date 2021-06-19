@extends('adminlte::page')

@section('title', 'Pisang Krispi Rendi')

@section('content_header')
    <h1>Data Testing</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
        <div class="row text-center">
            <h3> <i class="ion ion-android-people"></i> Data Testing</h3> 
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#testingModal" data-backdrop="static"> <i class="fas fa-plus" style="font-size: 20px;"></i> <b style="font-size: 20px;">Tambah Data Testing </b></button>
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
            <div class="col-lg-12">
                <span>Data Mentah</span>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered text-nowrap" id="datatable">
                        <thead class="bg-success">
                        <tr>
                            <th>No </th>
                            <th> Tanggal </th>
                            <th> Hari </th>
                            <th> Cuaca </th>
                            <th> Terjual </th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataT as $d)
                            <tr>
                                <td><b>{{$loop->iteration}}</b></td>
                                <td>{{$d->tanggal}}</td>
                                <td>{{$d->hari}}</td>
                                <td>{{$d->cuaca}}</td>
                                <td>{{$d->terjual}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="testingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title" id="exampleModalLabel"> <i class="ion ion-android-person-add"></i> Input Data </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form"  action="{{ route('dataTestings.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4 offset-md-2">
                                          <!-- select -->
                                          <div class="form-group">
                                                <label>Tanggal</label>
                                              <input type="date" name="tanggal" class="form-control">
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                              <label>Cuaca</label>
                                              <select class="form-control" name="cuaca">
                                                <option value="1">Cerah</option>
                                                <option value="2">Hujan</option>
                                              </select>
                                            </div>
                                          </div>
                                      </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Analisa</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title" id="exampleModalLabel"> <i class="ion ion-android-person-add"></i> Upload Data </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                    <form role="form"  action="{{ route('dataTrainings.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="data_training">Upload Data Training</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    Browse… <input type="file" id="imgInp" name="data_training">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
                </div>
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