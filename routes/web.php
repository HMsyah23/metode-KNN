<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/calon-penerima', function () {
    return view('penerima.index');
})->name('penerima');




Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::get('/home','HomeController@index')->name('admin.home');
    Route::get('/laporan/calonpenerima','ReportController@laporanSemuaCalonPenerima')->name('laporan.calonpenerima');
    Route::get('/laporan/calonpenerima/{id}','ReportController@laporanCalonPenerima')->name('laporan.calonpenerima.individu');
    Route::resource('kriterias','KriteriaController');
    Route::resource('dataTrainings','DataTrainingController');
    Route::resource('dataTestings','DataTestingController');
    Route::resource('akuns','AkunController');
    Route::resource('calonpenerimas','CalonPenerimaController');
    Route::get('/ranking','RankingController@index')->name('ranking');
    Route::get('/ranking/detail','RankingController@detail')->name('ranking.detail');
    Route::post('/dataTraining','DataTrainingController@dataTraining')->name('dataTraining.train');
    Route::get('/penjelasan','HomeController@penjelasan')->name('penjelasan');
});


Auth::routes();
