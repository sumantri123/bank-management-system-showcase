<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalBagianDetail extends Model
{
    protected $table = 't_jurnal_bagian_detail';

    protected $primaryKey = 'jurnal_det_id';

    public $timestamps = false;
    protected $fillable = [
        'jurnal_det_id',
		'id_perkiraan',
		'id_jurnal_bagian',
		'id_jenis_transaksi',
		'jurnal_det_nominal',
		'jurnal_det_nominal_valas',
		'id_rekening',
		'id_kode_transaksi',
		'dt_record',
		'user_record',
		'dt_modified',
		'user_modified',		
    ];

	public function Perkiraan(){
		return $this->hasOne('App\Models\EditPerkiraan');
	}
	
	public function KodeTransaksi(){
		return $this->hasOne('App\Models\KodeTransaksi');
	}

	public function JurnalBagian(){
		return $this->hasOne('App\Models\JurnalBagian');
	}
}

