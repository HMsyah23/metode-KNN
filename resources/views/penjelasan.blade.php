@extends('adminlte::page')

@section('title', 'Pisang Krispi Rendi')

@section('content_header')
    <h1>Penjelasan Metode K-NN</h1>
@stop

@section('content')
<div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="row text-justify">
        <div class="col">
            <p>
              <strong>Algoritma K-Nearest Neighbor (K-NN)</strong> adalah sebuah metode klasifikasi
              terhadap sekumpulan data berdasarkan pembelajaran data yang sudah terklasifikasikan sebelumnya, Termasuk dalam <i>supervised learning</i>
              dimana hasil query instance yang baru, diklasifikasi berdasarkan mayoritas kedekatan jarak dari kategori yang ada dalam K-NN.
            </p>

            <p>
              <strong>Tahapan Langkah Algoritma K-NN</strong>
              <ul>
                <li>
                  Menetukan parameter k (jumlah tetangga paling dekat).
                </li>
                <li>
                  Menentukan kuadrat jarak Eucliden Objek terhadap data training yang diberikan.
                </li>
                <li><img src="{{asset('image/rumus.jpg')}}" alt="" style="width:15%;"></li>
                <li>
                  Mengurutkan hasil jarak antar data secara discanding (berurutan dari nilai rendah ke tinggi).
                </li>
                <li>
                  Mengumpulkan kategori Y (Klasifikasi Nearest Neighbor berdasarkan nilai K).
                </li>
                <li>
                  Dengan menggunakan kategori Nearest Neighbor yang paling mayoritas maka dapat diprediksikan kategori objek.
                </li>
              </ul>
            </p>
        </div>
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