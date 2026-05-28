<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NasabahIndividu extends Model
{
    protected $table = 'm_nasabah';

    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id',
		'cif',
		'nama',
		'tempat_lahir',
		'tanggal_lahir',
		'kewarganegaraan',
		'alamat_ktp',
		'kota_ktp',
		'rt_ktp',
		'rw_ktp',
		'kelurahan_ktp',
		'kodepos_ktp',
		'telepon',
		'jenis_kelamin',
		'status',
		'pendidikan',
		'agama',
		'jenis_identitas',
		'no_identitas',
		'masa_berlaku',
		'kecamatan_ktp',
		'npwp',
		'dt_record',
		'user_record',
		'dt_modified',
		'user_modified',
		'alamat_domisili',
		'rt_domisili',
		'rw_domisili',
		'kelurahan_domisili',
		'kecamatan_domisili',
		'kota_domisili',
		'kodepos_domisili',
		'telp_domisili',
		'hp_domisili',
		'fax_domisili',
		'email_domisili',
		'status_rumah_domisili',
		'alamat_korespondensi',
		'nama_ibu_kandung',
		'nama_saudara',
		'hubungan_saudara',
		'kodepos_saudara',
		'alamat_saudara',
		'kota_saudara',
		'hp_saudara',
		'telp_saudara',
		'fax_saudara',
		'pekerjaan',
		'penghasilan',
		'nama_kantor',
		'kegiatan_usaha',
		'alamat_kantor',
		'kota_kantor',
		'kodepos_kantor',
		'telp_kantor',
		'ext_kantor',
		'fax_kantor',
		'jabatan_kantor',
		'unit_kantor',
		'jenis_badan_usaha',
		'sumber_dana',
		'id_file',
		'id_kelas',
		'nama_ahli_waris',
		'alamat_ahli_waris',
		'transaksi_tertinggi',
		'hubungan_ahli_waris',
		'kota_ahli_waris',
		'masuk_dhbi',
		'tujuan_buka_rekening',
		'penggunaan_dana',		
		'status_nasabah',
		'no_akta_pendirian',
		'anggaran_dasar',
		'email_perusahaan',
		'fax_perusahaan',
		'siup',
		'tdp',
		'ms_berlaku_tdp',
		'negara_investor',
		'kuasa_pemegang_rekening_1',
		'kuasa_pemegang_rekening_2',
		'sa_giro_temp',
		'sa_tab_temp',
		'sa_dep_temp',
		'sa_pin_temp',
		'sa_pin_temp_2',
		'sa_pinkre_temp',
		'jangka_waktu_temp',
		'irr_temp',
		'suku_bunga',
		'provisi',
		'username',
		'password_mbanking',
		'pin_mbanking',
		'nama_panggilan',
    ];

	public function kelas(){
		return $this->hasOne('App\Models\Kelas');
	}

	public function pendidikanx(){
		return $this->hasOne('App\Models\Pendidikan');
	}
   
	public function status(){
		return $this->hasOne('App\Models\Status');
	}

	public function agama(){
		return $this->hasOne('App\Models\Agama');
	}

	public function identitas(){
		return $this->hasOne('App\Models\JenisIdentitas');
	}

	public function Penghasilan(){
		return $this->hasOne('App\Models\Penghasilan');
	}

	public function sumberDana(){
		return $this->hasOne('App\Models\SumberDana');
	}

	public function File(){
		return $this->hasOne('App\Models\File');
	}

	public function pekerjaan(){
		return $this->hasOne('App\Models\Pekerjaan');
	}

	public function RekeningNasabah()
    {
        return $this->belongsTo('App\Models\TRekeningNasabah');
    }
	
}

