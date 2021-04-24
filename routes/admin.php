<?php

Route::get('/', 'HomeController@index')->name('dashboard');

//Route::get('/kjpp', 'KjppController@index')->name('kjpp.index');
//Route::get('/kjpp/create', 'KjppController@create')->name('kjpp.create');
//Route::post('/kjpp', 'KjppController@store')->name('kjpp.store');
//Route::get('/kjpp/{kjpp}/edit', 'KjppController@edit')->name('kjpp.edit');
//Route::put('/kjpp/{kjpp}', 'KjppController@update')->name('kjpp.update');
//Route::delete('/kjpp/{kjpp}', 'KjppController@destroy')->name('kjpp.destroy');

Route::get('/kjpps/data', 'DataController@kjpps')->name('kjpps.data');
Route::resource('kjpps', 'KjppsController');

//Route::get('/BU', 'BUController@index')->name('BU.index');
//Route::get('/BU/create', 'BUController@create')->name('BU.create');
//Route::post('/BU', 'BUController@store')->name('BU.store');
//Route::get('/BU/{BU}/edit', 'BUController@edit')->name('BU.edit');
//Route::put('/BU/{BU}', 'BUController@update')->name('BU.update');
//Route::delete('/BU/{BU}', 'BUController@destroy')->name('BU.destroy');

Route::get('/bus/data', 'DataController@bus')->name('bus.data');
Route::resource('bus', 'BusController');

//Route::get('/lokasi', 'LokasiController@index')->name('lokasi.index');
//Route::get('/lokasi/create', 'LokasiController@create')->name('lokasi.create');
//Route::post('/lokasi', 'LokasiController@store')->name('lokasi.store');
//Route::get('/lokasi/{lokasi}/edit', 'LokasiController@edit')->name('lokasi.edit');
//Route::put('/lokasi/{lokasi}', 'LokasiController@update')->name('lokasi.update');
//Route::delete('/lokasi/{lokasi}', 'LokasiController@destroy')->name('lokasi.destroy');


//Route::get('/status', 'StatusController@index')->name('status.index');
//Route::get('/status/create', 'StatusController@create')->name('status.create');
//Route::post('/status', 'StatusController@store')->name('status.store');
//Route::get('/status/{status}/edit', 'StatusController@edit')->name('status.edit');
//Route::put('/status/{status}', 'StatusController@update')->name('status.update');
//Route::delete('/status/{status}', 'StatusController@destroy')->name('status.destroy');




//Route::get('/PIC', 'PICController@index')->name('PIC.index');
//Route::get('/PIC/create', 'PICController@create')->name('PIC.create');
//Route::post('/PIC', 'PICController@store')->name('PIC.store');
//Route::get('/PIC/{PIC}/edit', 'PICController@edit')->name('PIC.edit');
//Route::put('/PIC/{PIC}', 'PICController@update')->name('PIC.update');
//Route::delete('/PIC/{PIC}', 'PICController@destroy')->name('PIC.destroy');

Route::get('/users/data', 'DataController@users')->name('users.data');
Route::resource('users', 'PicController');
Route::get('/users/{user}/reset', 'PicController@reset')->name('users.reset');

Route::get('/holidays/data', 'DataController@holidays')->name('holidays.data');
Route::resource('holidays', 'HolidaysController');

//Route::get('/review', 'ReviewController@index')->name('review.index');
//Route::get('/review/create', 'ReviewController@create')->name('review.create');
//Route::post('/review', 'ReviewController@store')->name('review.store');

//Route::get('/load/data', 'DataController@load')->name('load.data');
//Route::resource('load', 'LoadController');

Route::get('/reviews/data', 'DataController@reviews')->name('reviews.data');
Route::resource('reviews', 'ReviewsController');

Route::get('/developer/data', 'DataController@developer')->name('developer.data');
Route::resource('developer', 'DeveloperController');

Route::get('/flpps/data', 'DataController@flpps')->name('flpps.data');
Route::resource('flpps', 'FlppsController');

Route::get('/internal/data', 'DataController@internal')->name('internal.data');
Route::resource('internal', 'InternalController');

Route::get('/vercall/data', 'DataController@vercall')->name('vercall.data');
Route::resource('vercall', 'VercallController');


Route::get('/kerjareview/data', 'DataController@kerjareviews')->name('kerjareview.data');
Route::resource('kerjareview', 'KerjareviewController');