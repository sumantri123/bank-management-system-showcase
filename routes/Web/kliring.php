<?php

	//-- jurnal Bagian
	//Route::get('/jurnalBagian/UEI=','JurnalBagianController@index');

	Route::get('/kliring/{kode}','KliringController@index');      
	Route::get('/GetSandiTransaksi/{id}','KliringController@getSandiTransaksiId');
	Route::get('/GetPerkiraanKliring/{id}','KliringController@getIdPerkiraan2');
	Route::post('/getDataBankLain','KliringController@getKodeKliringBL'); 
	Route::post('/getDataBankAsal','KliringController@getKodeKliringBA'); 
	Route::post('/kliring','KliringController@store')->middleware(['sanitize', 'open']);
	Route::post('/search/kliring','KliringController@search');
	Route::post('/delete/kliring','KliringController@destroy');

	// Laporan Hasil Kliring Debet
    Route::get('/lap_kliring_serah','LapKliringSerahController@index');        
    Route::post('/getDataLapKliringSerah/lapKliringSerah','LapKliringSerahController@getData'); 

	// Laporan Hasil Kliring Kredit
    Route::get('/lap_kliring_terima','LapKliringTerimaController@index');        
    Route::post('/getDataLapKliringTerima/lapKliringTerima','LapKliringTerimaController@getData'); 