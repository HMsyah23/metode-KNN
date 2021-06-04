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

    table.des-header{
        width: 100%;	
        margin-top: 10px;	
        /*border:1px solid black;*/
    }
    .des-header tr th{
        background-color: #5eb373;
        color: white;
        padding: 10px;
        font-size: 10px;	
    }
    .des-header tr td{
        text-align: center;
        background-color: white;
    }
    .des-header tr:hover td{
        
    }

    </style>
<div>
    <table class="des-header">
        <tr>
          <td rowspan="5"> <img src="{{asset('image/Logo.png')}}" alt="" style="width: 10%"></td>
        </tr>
        <tr>
          <td><h3>PEMERINTAH KABUPATEN KUTAI KARTANEGARA</h3></td>
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
            <tr><td colspan="8" style="background-color:#abfabfd2; color:rgb(8, 53, 4); font-size:20px;"> <h4>Daftar Calon Penerima Bantuan Program RTLH</h4></td></tr>
          <tr>
            <th>No KK</th>
            <th>No KTP</th>
            <th>Nama Kepala Keluarga</th>
            <th>Alamat</th>
            <th>Pendapatan Kepala Keluarga Per Bulan</th>
            <th>Jumlah Tanggungan</th>
            <th>Luas Tanah/Tempat Hunian</th>
            <th>Kondisi Rumah</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($calons as $calon)
            <tr>
              <td>{{$calon->no_kk}}</td>
              <td>{{$calon->no_ktp}}</td>
              <td>{{$calon->nama_kepala_keluarga}}</td>
              <td>{{$calon->alamat}}</td>
              <td>Rp. {{$calon->pendapatan}}</td>
              <td>{{$calon->jumlah_tanggungan}} Orang</td>
              <td>{{$calon->luas_tanah}} m<sup>2</sup>/orang</td>
              <td>Sangat Tidak Layak</td>
          </tr>
            @endforeach
        </tbody>
    </table>
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