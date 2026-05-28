<?php
	Route::get('/testimoni','TestimoniController@index');              
    Route::get('/getDataJson/testimoni','TestimoniController@getData')->name('testimoni.data'); 
	Route::get('/delete/testimoni/{id}','TestimoniController@destroy');	
	Route::post('/testimoni','TestimoniController@store')->name('testimoni.save');
	Route::put('/testimoni/{id}','TestimoniController@update')->name('testimoni.update');  