<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeracaAkhirDetail extends Model
{
    protected $table = 't_neraca_akhir_detail';

    protected $primaryKey = 'neraca_akhir_detail_id';

    public $timestamps = false;
    protected $fillable = [
        'neraca_akhir_detail_id',
		'id_neraca_akhir',
		'id_perkiraan',
		'saldo_yt',
		'saldo_mutasi_td',
		'saldo_akhir',
		'created_at',		
		'updated_at'		
    ];	
	
}

