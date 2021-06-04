<style>

.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
    *{
        
    }
    /*tabel*/
    h2{
        text-align: center;
    }
    .overflow{
        width: 100%;
        overflow: auto;	
    }
    table.des-ta{
        width: 100%;	
        margin-top: 10px;	
        /*border:1px solid black;*/
    }
    .des-ta tr th{
        background-color: #5eb373;
        color: white;
        padding: 10px;
        font-size: 10px;	
    }
    .des-ta tr td{
        padding: 10px;
        text-align: center;
        background-color: #e7e7e7;
        font-size: 10px;
    }
    .des-ta tr:hover td{
        
    }

    </style>
<div>
    <table>
        <tr>
          <td rowspan="5"> <img src="{{asset('image/Logo.png')}}" alt="" style="width: 10%"></td>
        </tr>
        <tr style="text-align: center;">
          <td style="text-align: center;"><h3>PEMERINTAH KABUPATEN KUTAI KARTANEGARA</h3></td>
        </tr>
        <tr>
            <td><h4>KECAMATAN TENGGARONG SEBERANG</h4></td>
          </tr>
          <tr>
            <td><h5>DESA BUKIT PARIAMAN</h5></td>
          </tr>
          {{-- <tr>
            <td><u>Sugeng Hariyadi</u></td>
          </tr> --}}
      </table>
    <hr>
    <table class="des-ta">
        <thead>
            <tr><td colspan="3" style="background-color:#5eb373; color:white;"> <h4>Informasi Calon Penerima Bantuan Program RTLH</h4></td></tr>
          <tr>
            <th>No KK</th>
            <th>{{$calon->no_kk}}</th>
            <th>Foto KTP</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <th>No Ktp Kepala Keluarga</th>
            <td>{{$calon->no_ktp}}</td>
            <td rowspan="8">
                <img src="{{ asset('storage/' .$calon->foto_ktp)  }}" alt="" style="width: 230px; height:200px;">
            </td>
        </tr>
        
        <tr>
            <th>Nama Kepala Keluarga</th>
            <td>{{$calon->nama_kepala_keluarga}}</td>
        </tr>
        
        <tr>
            <th>Alamat</th>
            <td>{{$calon->alamat}}</td>
        </tr>
        
        <tr>
            <th>Pendapatan Kepala Keluarga Per Bulan</th>
            <th>Rp. {{$calon->pendapatan}}</th>
        </tr>
        
            <tr>
            <th>Jumlah Tanggungan</th>
            <td>{{$calon->jumlah_tanggungan}} Orang</td>
        </tr>
        
        <tr>
            <th>Luas Tanah/Tempat Hunian</th>
            <td>{{$calon->luas_tanah}} m<sup>2</sup>/orang</td>
        </tr>
        
        </tbody>
    </table>
    <div class="row">
            <table class="des-ta">
                <tr><td colspan="2"> <h4>Keadaan Rumah</h4></td></tr>
                <tr>
                    <td rowspan="5">Kondisi Rumah</td>
                    <th>Tidak Layak Huni</th>
                </tr>
                @foreach( json_decode($calon->kondisi_rumah) as $status)
                <tr>
                    <td style="font-size: 10px;">{{$status}}</td>
                </tr>
                
                @endforeach 
            </table>
    </div>
    <div class="row">
        <table class="des-ta">
            <tr><td colspan="2" style="background-color:#5eb373; color:white;"> <h4>Foto Rumah</h4></td></tr>
        </table>
        <div style="background-color: #e7e7e7;" >
            @foreach (json_decode($calon->foto_rumah) as $rumah)
            <img src="{{ asset('storage/calonpenerimas/foto_rumah/' .$rumah)  }}" class="center" alt="Responsive image" style="width: 120px; height:120px;">
        @endforeach
        </div>
    </div>
    <div style="float: right; width: 28%;margin-top: 50px;">
        <table>
          <tr>
            <td>Kepala Desa Bukit Pariaman,</td>
          </tr>
          <tr>
            <td style="height: 50px;"></td>
          </tr>
          <tr>
            <td><u>Sugeng Hariyadi</u></td>
          </tr>
        </table>
      </div>
</div>