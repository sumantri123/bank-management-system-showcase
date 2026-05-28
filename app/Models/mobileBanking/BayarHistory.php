<?php

namespace App\Models\mobileBanking;

use Illuminate\Database\Eloquent\Model;

class BayarHistory extends Model
{
    protected $table = 't_bayar_history';

    protected $primaryKey = 'bayar_id';

    public $timestamps = false;
    protected $fillable = [
        "bayar_id",
        "bayar_jenis",
		"bayar_keterangan",        
        "id_nasabah",
		"id_jurnal_bagian",		
		"bayar_token_pln",	
		"bayar_no_pelanggan",
		"id_daftar_transfer",
		"bayar_pembelian",
		"bayar_admin",
		"bayar_dari_tf_ket"
    ];
    
}

