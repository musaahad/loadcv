<?php

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


//Route::get('/review/{review}','Frontend\KerjareviewController@show')->name('load.show');
//Route::get('/internal/{internal}','Frontend\KerjareviewController@show1')->name('load.show1');

//Route::get('/load/create', 'Frontend\LoadController@create')->name('load.create')->middleware('auth');


Route::post('/kerjareview/create', 'Frontend\KerjareviewController@create')->name('kerjareview.create')->middleware('auth');
Route::post('/kerjareview/tambah', 'Frontend\KerjareviewController@tambah')->name('kerjareview.tambah')->middleware('auth');
Route::get('/kerjareview/{kerjareview}/edit','Frontend\KerjareviewController@edit')->name('kerjareview.edit')->middleware('auth');//yg bisa akses tombol kerjakan hanya user yg sdh login
Route::put('/kerjareview/{kerjareview}','Frontend\KerjareviewController@update')->name('kerjareview.update')->middleware('auth');
Route::get('/kerjareview/show', 'Frontend\KerjareviewController@show')->name('kerjareview.show')->middleware('auth');
Route::get('/kerjareview/laporan','Frontend\KerjareviewController@laporan')->name('kerjareview.laporan')->middleware('auth');
Route::get('/kerjareview/workform','Frontend\KerjareviewController@workform')->name('kerjareview.workform')->middleware('auth');
Route::get('/kerjareview/checklist','Frontend\KerjareviewController@checklist')->name('kerjareview.checklist')->middleware('auth');
Route::delete('/kerjareview/{kerjareview}/hapus', 'Frontend\KerjareviewController@destroy')->name('kerjareview.destroy')->middleware('auth');
Route::post('/kerjareview/city', 'Frontend\KerjareviewController@city')->name('kerjareview.city')->middleware('auth');
Route::post('/kerjareview/districs', 'Frontend\KerjareviewController@districs')->name('kerjareview.districs')->middleware('auth');
Route::post('/kerjareview/villages', 'Frontend\KerjareviewController@villages')->name('kerjareview.villages')->middleware('auth');
Route::get('/kerjareview/data', 'Frontend\KerjareviewController@data')->name('kerjareview.data')->middleware('auth');
Route::get('/kerjareview/dataall', 'Frontend\KerjareviewController@dataall')->name('kerjareview.dataall')->middleware('auth');
Route::get('/kerjareview/database', 'Frontend\KerjareviewController@database')->name('kerjareview.database')->middleware('auth');
Route::get('/kerjareview/datanilai', 'Frontend\KerjareviewController@datanilai')->name('kerjareview.datanilai')->middleware('auth');
Route::get('/kerjareview/{kerjareview}/detail','Frontend\KerjareviewController@detail')->name('kerjareview.detail')->middleware('auth');



Route::post('/kerjainternal/create', 'Frontend\KerjainternalController@create')->name('kerjainternal.create')->middleware('auth');
Route::post('/kerjainternal/tambah', 'Frontend\KerjainternalController@tambah')->name('kerjainternal.tambah')->middleware('auth');
Route::get('/kerjainternal/{kerjainternal}/edit','Frontend\KerjainternalController@edit')->name('kerjainternal.edit')->middleware('auth');//yg bisa akses tombol kerjakan hanya user yg sdh login
Route::put('/kerjainternal/{kerjainternal}','Frontend\KerjainternalController@update')->name('kerjainternal.update')->middleware('auth');
Route::get('/kerjainternal/show', 'Frontend\KerjainternalController@show')->name('kerjainternal.show')->middleware('auth');
Route::get('/kerjainternal/laporan','Frontend\KerjainternalController@laporan')->name('kerjainternal.laporan')->middleware('auth');
Route::get('/kerjainternal/workform','Frontend\KerjainternalController@workform')->name('kerjainternal.workform')->middleware('auth');
Route::get('/kerjainternal/checklist','Frontend\KerjainternalController@checklist')->name('kerjainternal.checklist')->middleware('auth');
Route::delete('/kerjainternal/{kerjainternal}/hapus', 'Frontend\KerjainternalController@destroy')->name('kerjainternal.destroy')->middleware('auth');
Route::post('/kerjainternal/city', 'Frontend\KerjainternalController@city')->name('kerjainternal.city')->middleware('auth');
Route::post('/kerjainternal/districs', 'Frontend\KerjainternalController@districs')->name('kerjainternal.districs')->middleware('auth');
Route::post('/kerjainternal/villages', 'Frontend\KerjainternalController@villages')->name('kerjainternal.villages')->middleware('auth');
Route::get('/kerjainternal/data', 'Frontend\KerjainternalController@data')->name('kerjainternal.data')->middleware('auth');
Route::get('/kerjainternal/dataall', 'Frontend\KerjainternalController@dataall')->name('kerjainternal.dataall')->middleware('auth');
Route::get('/kerjainternal/laporan','Frontend\KerjainternalController@laporan')->name('kerjainternal.laporan')->middleware('auth');
Route::get('/kerjainternal/database', 'Frontend\KerjainternalController@database')->name('kerjainternal.database')->middleware('auth');
Route::get('/kerjainternal/datanilai', 'Frontend\KerjainternalController@datanilai')->name('kerjainternal.datanilai')->middleware('auth');
Route::get('/kerjainternal/{kerjainternal}/detail','Frontend\KerjainternalController@detail')->name('kerjainternal.detail')->middleware('auth');



Route::post('/kerjaflpp/create', 'Frontend\KerjaflppController@create')->name('kerjaflpp.create')->middleware('auth');
Route::post('/kerjaflpp/tambah', 'Frontend\KerjaflppController@tambah')->name('kerjaflpp.tambah')->middleware('auth');
Route::get('/kerjaflpp/{kerjaflpp}/edit','Frontend\KerjaflppController@edit')->name('kerjaflpp.edit')->middleware('auth');//yg bisa akses tombol kerjakan hanya user yg sdh login
Route::put('/kerjaflpp/{kerjaflpp}','Frontend\KerjaflppController@update')->name('kerjaflpp.update')->middleware('auth');
Route::get('/kerjaflpp/show', 'Frontend\KerjaflppController@show')->name('kerjaflpp.show')->middleware('auth');
Route::get('/kerjaflpp/laporan','Frontend\KerjaflppController@laporan')->name('kerjaflpp.laporan')->middleware('auth');
Route::get('/kerjaflpp/workform','Frontend\KerjaflppController@workform')->name('kerjaflpp.workform')->middleware('auth');
Route::get('/kerjaflpp/checklist','Frontend\KerjaflppController@checklist')->name('kerjaflpp.checklist')->middleware('auth');
Route::delete('/kerjaflpp/{kerjaflpp}/hapus', 'Frontend\KerjaflppController@destroy')->name('kerjaflpp.destroy')->middleware('auth');
Route::get('/kerjaflpp/data', 'Frontend\KerjaflppController@data')->name('kerjaflpp.data')->middleware('auth');
Route::get('/kerjaflpp/dataall', 'Frontend\KerjaflppController@dataall')->name('kerjaflpp.dataall')->middleware('auth');
Route::get('/kerjaflpp/laporan','Frontend\KerjaflppController@laporan')->name('kerjaflpp.laporan')->middleware('auth');



Route::post('/datapasar/create', 'Frontend\DatapasarController@create')->name('datapasar.create')->middleware('auth');
Route::get('/datapasar/show', 'Frontend\DatapasarController@show')->name('datapasar.show')->middleware('auth');
Route::get('/datapasar/showinternal', 'Frontend\DatapasarController@showinternal')->name('datapasar.showinternal')->middleware('auth');
Route::get('/datapasar/{datapasar}/edit','Frontend\DatapasarController@edit')->name('datapasar.edit')->middleware('auth');

Route::get('/datapasar/{datapasar}/editinternal','Frontend\DatapasarController@editinternal')->name('datapasar.editinternal')->middleware('auth');
Route::get('/datapasar/data', 'Frontend\DatapasarController@data')->name('datapasar.data')->middleware('auth');
Route::get('/datapasar/datainternal', 'Frontend\DatapasarController@datainternal')->name('datapasar.datainternal')->middleware('auth');
Route::get('/datapasar/dataall', 'Frontend\DatapasarController@dataall')->name('datapasar.dataall')->middleware('auth');
Route::put('/datapasar/{datapasar}/update','Frontend\DatapasarController@update')->name('datapasar.update')->middleware('auth');
Route::put('/datapasar/{datapasar}/updateinternal','Frontend\DatapasarController@updateinternal')->name('datapasar.updateinternal')->middleware('auth');
Route::delete('/datapasar/{datapasar}/hapus', 'Frontend\DatapasarController@destroy')->name('datapasar.destroy')->middleware('auth');
Route::delete('/datapasar/{datapasar}/hapusinternal', 'Frontend\DatapasarController@destroyinternal')->name('datapasar.destroyinternal')->middleware('auth');
Route::get('/datapasar/index', 'Frontend\DatapasarController@index')->name('datapasar.index')->middleware('auth');
Route::get('/datapasar/{datapasar}/detail', 'Frontend\DatapasarController@detail')->name('datapasar.detail')->middleware('auth');



Route::post('/tanah/create', 'Frontend\TanahController@create')->name('tanah.create')->middleware('auth');
Route::get('/tanah/show', 'Frontend\TanahController@show')->name('tanah.show')->middleware('auth');
Route::get('/tanah/showinternal', 'Frontend\TanahController@showinternal')->name('tanah.showinternal')->middleware('auth');
Route::get('/tanah/{tanah}/edit','Frontend\TanahController@edit')->name('tanah.edit')->middleware('auth');
Route::get('/tanah/{tanah}/editinternal','Frontend\TanahController@editinternal')->name('tanah.editinternal')->middleware('auth');
Route::get('/tanah/data', 'Frontend\TanahController@data')->name('tanah.data')->middleware('auth');
Route::get('/tanah/datainternal', 'Frontend\TanahController@datainternal')->name('tanah.datainternal')->middleware('auth');
Route::put('/tanah/{tanah}/update','Frontend\TanahController@update')->name('tanah.update')->middleware('auth');
Route::put('/tanah/{tanah}/updateinternal','Frontend\TanahController@updateinternal')->name('tanah.updateinternal')->middleware('auth');
Route::delete('/tanah/{tanah}/hapus', 'Frontend\TanahController@destroy')->name('tanah.destroy')->middleware('auth');
Route::delete('/tanah/{tanah}/hapusinternal', 'Frontend\TanahController@destroyinternal')->name('tanah.destroyinternal')->middleware('auth');

Route::post('/bangunan/create', 'Frontend\BangunanController@create')->name('bangunan.create')->middleware('auth');
Route::get('/bangunan/show', 'Frontend\BangunanController@show')->name('bangunan.show')->middleware('auth');
Route::get('/bangunan/showinternal', 'Frontend\BangunanController@showinternal')->name('bangunan.showinternal')->middleware('auth');
Route::get('/bangunan/{bangunan}/edit','Frontend\BangunanController@edit')->name('bangunan.edit')->middleware('auth');
Route::get('/bangunan/{bangunan}/editinternal','Frontend\BangunanController@editinternal')->name('bangunan.editinternal')->middleware('auth');
Route::get('/bangunan/data', 'Frontend\BangunanController@data')->name('bangunan.data')->middleware('auth');
Route::get('/bangunan/datainternal', 'Frontend\BangunanController@datainternal')->name('bangunan.datainternal')->middleware('auth');
Route::put('/bangunan/{bangunan}/update','Frontend\BangunanController@update')->name('bangunan.update')->middleware('auth');
Route::put('/bangunan/{bangunan}/updateinternal','Frontend\BangunanController@updateinternal')->name('bangunan.updateinternal')->middleware('auth');
Route::delete('/bangunan/{bangunan}/hapus', 'Frontend\BangunanController@destroy')->name('bangunan.destroy')->middleware('auth');
Route::delete('/bangunan/{bangunan}/hapusinternal', 'Frontend\BangunanController@destroyinternal')->name('bangunan.destroyinternal')->middleware('auth');

Route::post('/mesinspl/create', 'Frontend\MesinsplController@create')->name('mesinspl.create')->middleware('auth');
Route::get('/mesinspl/show', 'Frontend\MesinsplController@show')->name('mesinspl.show')->middleware('auth');
Route::get('/mesinspl/showinternal', 'Frontend\MesinsplController@showinternal')->name('mesinspl.showinternal')->middleware('auth');
Route::get('/mesinspl/{mesinspl}/edit','Frontend\MesinsplController@edit')->name('mesinspl.edit')->middleware('auth');
Route::get('/mesinspl/{mesinspl}/editinternal','Frontend\MesinsplController@editinternal')->name('mesinspl.editinternal')->middleware('auth');
Route::get('/mesinspl/data', 'Frontend\MesinsplController@data')->name('mesinspl.data')->middleware('auth');
Route::get('/mesinspl/datainternal', 'Frontend\MesinsplController@datainternal')->name('mesinspl.datainternal')->middleware('auth');
Route::put('/mesinspl/{mesinspl}/update','Frontend\MesinsplController@update')->name('mesinspl.update')->middleware('auth');
Route::put('/mesinspl/{mesinspl}/updateinternal','Frontend\MesinsplController@updateinternal')->name('mesinspl.updateinternal')->middleware('auth');
Route::delete('/mesinspl/{mesinspl}/hapus', 'Frontend\MesinsplController@destroy')->name('mesinspl.destroy')->middleware('auth');
Route::delete('/mesinspl/{mesinspl}/hapusinternal', 'Frontend\MesinsplController@destroyinternal')->name('mesinspl.destroyinternal')->middleware('auth');

Auth::routes(['verify'=> true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //jika user sdh login, maka diarahkan ke halaman ini
//Route::get('/', 'Frontend\KerjareviewController@index')->name('homepage'); //di navigation terdapat route homepage
Route::get('/kerjareview', 'Frontend\KerjareviewController@index')->name('kerjareview.index')->middleware('auth');
Route::get('/kerjaflpp', 'Frontend\KerjaflppController@index')->name('kerjaflpp.index')->middleware('auth');
Route::get('/kerjainternal', 'Frontend\KerjainternalController@index')->name('kerjainternal.index')->middleware('auth');
Route::get('/', 'HomeController@index')->name('homepage')->middleware('verified');//hanya email yg sdh terverifikasi yg bisa masuk