<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TRekeningNasabah extends Model
{
    protected $table = 't_rekening_nasabah';

    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
		'id_perkiraan',
		'id_jenis_rekening',
		'id_pinjaman',
		'id_nasabah',
		'nomor_rekening',
		'tanggal_buka',
		'sandi_pemilik',
		'diskonto',
		'bunga',
		'jenis_pembayaran',
		'jangka',
		'id_kelas',
		'jangka_sertifikat',
		'status',
		'prk',
		'prk_nominal',
		'dt_record',
		'user_record',
		'dt_modified',
		'user_modified',
		'mobile',
		'merchant',
    ];

	public function kelas(){
		return $this->hasOne('App\Models\Kelas');
	}

	public function perkiraan(){
		return $this->hasOne('App\Models\EditPerkiraan');
	}
   
	public function jenisRekening(){
		return $this->hasOne('App\Models\JenisRekening');
	}

	public function nasabah(){
		return $this->hasOne('App\Models\NasabahIndividu');
	}

	public function pinjaman(){
		return $this->hasOne('App\Models\JenisPinjaman');
	}

	public function sandiPemilik(){
		return $this->hasOne('App\Models\SandiPemilik');
	}
	
}

