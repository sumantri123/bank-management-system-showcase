<?php

namespace App\Http\Controllers\mobileBanking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use DB;
use Carbon\Carbon;

class MutasiController extends Controller
{

    // use AuthenticatesUsers;
    protected $redirectTo = '/';

	public function __construct()
    {		
        //$this->middleware('guest', ['except' => ['logout', 'login_as']]);
		$this->yearNow = Carbon::now()->year;
		$this->date = Carbon::now()->format('m/d/Y');
		$this->when = Carbon::now();
		$this->view = 'mobile/mutasi/';
		
    }
	
	public function index()
    {				
			
		$jenisRekening = array(2);
		$rekening = InitHelp::getRekening($jenisRekening);	
       		
        $data = array(            
			'header_title' => 'Mutasi Rekening',						
			'rekening' => $rekening['rekening'],
        );       
		
		return view($this->view.'index', compact('data'));
    }	
	
	public function mutasiRekening($param)
    {										
		$param = explode("|",$param);
		$bulan = $param[0];
		$tahun = $param[1];
		$idRek = $param[2];
		
		$awalDate = $tahun."-".$bulan."-01";
		
		$dataMutasi = DB::select(                
				
					DB::raw('
							select jurnal_tanggal, jurnal_keterangan, jurnal_det_nominal, id_jenis_transaksi, 
							jurnal_bagian_id, bayar_dari_tf_ket
							from t_jurnal_bagian_detail as a
							left join t_jurnal_bagian as b on a.id_jurnal_bagian = b.jurnal_bagian_id
							left join t_rekening_nasabah as c on a.id_rekening = c.id
							left join t_bayar_history as d on b.jurnal_bagian_id = d.id_jurnal_bagian
							where a.id_rekening = '.base64_decode($idRek).'
							and jurnal_tanggal BETWEEN  "'.$awalDate.'" and "'.date('Y-m-d', strtotime($this->date)).'"
							and jurnal_keterangan <> "Data Saldo Awal"
							order by jurnal_tanggal desc
						')
				); 
		
		
        $data = array(            
			'header_title' => 'Mutasi Rekening',						
			'rekening' => $dataMutasi,
        );       
		
		return view($this->view.'mutasi', compact('data'));
        
    }
}
