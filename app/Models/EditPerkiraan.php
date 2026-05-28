<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditPerkiraan extends Model
{
    protected $table = 'm_perkiraan';

    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
		'kode_perkiraan',
		'nama_perkiraan',
        'df_trans_perkiraan',		
        'id_jenis_transaksi',		
        'nominal_perkiraan',		        
		'id_lembaga',
		'dt_record',
		'user_record',
		'dt_modified',
		'user_modified',
		'kode_otomatis'
    ];	   

    public function RekeningNasabah()
    {
        return $this->belongsTo('App\Models\TRekeningNasabah');
    }

    public function JurnalBagianDet()
    {
        return $this->belongsTo('App\Models\JurnalBagianDetail');
    }
}
