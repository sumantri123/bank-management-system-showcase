<?php

namespace App\Models\mobileBanking;

use Illuminate\Database\Eloquent\Model;

class DaftarTransfer extends Model
{
    protected $table = 'm_daftar_transfer';

    protected $primaryKey = 'daftar_tf_id';

    public $timestamps = false;
    protected $fillable = [
        "daftar_tf_id",
        "id_nasabah_tujuan",
		"id_nasabah_asal",
        "id_kelas",
        "id_rekening",
		"nomor_rekening",
		"nama_nasabah",
		"daftar_tf_jenis",		
		"id_perkiraan_tujuan",
		"id_jenis_rekening",
		"bank_tf",
		"create_when",	
		"id_bayar_jenis",			
    ];
    
}

