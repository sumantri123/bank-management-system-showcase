<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route For Transfer
|
*/
	
	//-- jurnal Bagian
	//Route::get('/jurnalBagian/VEY=','JurnalBagianController@index');
	
    // Test Key
    Route::get('/testKey','TestKeyController@index');            
    Route::get('/GetPengirim/{id}','TestKeyController@getKodePengirim');
    Route::get('/GetPenerima/{id}','TestKeyController@getKodePenerima');
    Route::get('/GetTglBulan/{id}','TestKeyController@getKodeTglBulan');
    Route::post('/GetNominal','TestKeyController@getNominal');
    Route::post('/testKeySave','TestKeyController@store')->middleware(['sanitize', 'open']);
    Route::put('/testKeyUpdate/{id}','TestKeyController@update')->middleware('sanitize'); 
    Route::get('/delete/testKey/{id}','TestKeyController@destroy');
    Route::post('/search/testKey','TestKeyController@search');

    // Prefund
    Route::get('/prefund','InputPrefundController@index');            
    Route::get('/GetPerkiraanPrefund/{id}','InputPrefundController@getIdPerkiraan2');
    Route::post('/getDataKodeKliring','InputPrefundController@getKodeKliring'); 
    Route::post('/prefund','InputPrefundController@store')->middleware(['sanitize', 'open']); 
    Route::post('/delete/prefund','InputPrefundController@destroy');
    Route::post('/search/prefund','InputPrefundController@search');
	
	// Laporan Test Key    
    Route::get('/lapTestKey','LapTestKeyController@index');        
    Route::post('/getDataLapTestKey/lapTestKey','LapTestKeyController@getData'); 
	
	// Laporan RAAPKN Debet
    Route::get('/lapRaapknDebet','LapRAAPKNDebitController@index');                  
    Route::post('/getData/lapRaapknDebet','LapRAAPKNDebitController@getData'); 

    // Laporan RAAPKN Kredit
    Route::get('/lapRaapknKredit','LapRAAPKNKreditController@index');                  
    Route::post('/getData/lapRaapknKredit','LapRAAPKNKreditController@getData'); 