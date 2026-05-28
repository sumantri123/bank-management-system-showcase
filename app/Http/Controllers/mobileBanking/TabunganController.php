<?php

namespace App\Http\Controllers\mobileBanking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TRekeningNasabah;
use App\Models\mobileBanking\DaftarTransfer;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use Session;
use DB;
use Carbon\Carbon;

class TabunganController extends Controller
{

    // use AuthenticatesUsers;
    protected $redirectTo = '/';

	public function __construct()
    {		
        //$this->middleware('guest', ['except' => ['logout', 'login_as']]);
		$this->yearNow = Carbon::now()->year;
		$this->date = Carbon::now()->format('m/d/Y');
		$this->when = Carbon::now();
		$this->view = 'mobile/tabungan/';
		
    }
	
	public function index()
    {						
        $data = array(            
			'header_title' => 'SYARAT - SYARAT UMUM BAGI PEMEGANG REKENING PADA '.Session::get('nama_bank'),     
        );       
		
		return view($this->view.'syarat', compact('data'));
    }
	
	public function about()
    {						            
		$data = array(   
			'img' => 'tabungan2.jpg',     			    												
        );
		return view($this->view.'about_tabungan', compact('data'));
    }

	public function awal_setoran()
    {			
			
		$jenisRekening = array(1,2);
		$rekening = InitHelp::getRekening($jenisRekening);
		$getPin = InitHelp::getPin();
            
        $data = array(   
			'img' => 'pemandangan_1.jpg',     			    								
			'header_title' => 'Setoran Awal',     			    								
			'setoral_awal' => 50000,
			'rekening' => $rekening['rekening'],
			'pinMobile' => base64_encode($getPin[0]->pin_mbanking),		
			'saldo' => $rekening['saldo'],   		
        );   

		return view($this->view.'setoran_awal', compact('data'));
    }
	
	public function setoranStore(Request $request)
    {						
		$rekeningData = explode("|",($request->rekening));
		$idRekAsal = $rekeningData[0];
		$idPerAsal = $rekeningData[1];		
		$noRekAsal = $rekeningData[3];				
		$nominal = $request->nominal;
		$find = [","];
		$replace = [""];
		$newNominal = str_replace($find, $replace, $nominal);
		$jurnalNo = "MO-".time();
		$idNasabah = Session::get('idNasabah');		
		$bagian = "AT";
		$idPerkiraan = array($idPerAsal,Session::get('3XXTABUH_ID'));
		$idJenisTransaksi = array(1,2);		
		
		// 1. Create Rekening Tabungan
		$orderObj = DB::table('t_rekening_nasabah')
				->select('nomor_rekening')
				->where('id_perkiraan','=',Session::get('3XXTABUH_ID'))
				->where('id_kelas','=',Session::get('kelas'))
				->latest('id')
				->first();        

		if ($orderObj) {

			$lastKodeNumber = explode('.',$orderObj->nomor_rekening);
			$lastKodeNumber2 = $lastKodeNumber[1];			
			$KodeNumber2 = str_pad($lastKodeNumber2 + 1, 4, "0", STR_PAD_LEFT);
			
		} else {
			$KodeNumber2 = str_pad(1, 4, "0", STR_PAD_LEFT);                 
		}
		$kodePerkiraan = Session::get('3XXTABUH');
		$nomorRekening = $kodePerkiraan.'.'.$KodeNumber2;
		$jenisRekening = 2;
		$keterangan = "Setoran Awal Dari Rekening ".$noRekAsal." (Buka Rekening Tabungan : ".$nomorRekening.")";
		
		DB::beginTransaction();
		try {
			$insertRekening = TRekeningNasabah::create([
				"nomor_rekening"=> $nomorRekening,
				"id_perkiraan"=> Session::get('3XXTABUH_ID'),				
				"id_jenis_rekening"=> $jenisRekening,
				"id_nasabah"=> $idNasabah,				
				"tanggal_buka"=> date('Y-m-d', strtotime($this->date)),				
				"bunga"=> 0.40,                               
				"id_kelas"=> Session::get('kelas'),
				"user_record"=> "Mobile : ".ucwords(strtolower(Session::get('nama'))),
				"dt_record"=> date("Y-m-d H:i:s"),
				"mobile"=> "y",				
			]);
			
			// 2. Create Daftar Transfer Rekening
			$cekDaftarTransfer = DaftarTransfer::where('id_kelas', Session::get('kelas'))
							->where('id_nasabah_asal', Session::get('idNasabah'))
							->where('id_rekening', $insertRekening->id)
							->get();

			if(count($cekDaftarTransfer)==0){
				$insertDaftarTransfer = DaftarTransfer::create([
					"id_nasabah_asal"=> Session::get('idNasabah'),
					"id_nasabah_tujuan"=> $idNasabah,
					"id_kelas"=> Session::get('kelas'),								
					"id_rekening"=> $insertRekening->id,
					"id_jenis_rekening"=> 2,
					"nomor_rekening"=> $insertRekening->nomor_rekening,
					"nama_nasabah"=> Session::get('nama'),
					"daftar_tf_jenis"=> 1,                    
					"bank_tf"=> Session::get('nama_bank'),					
					"id_perkiraan_tujuan"=> $insertRekening->id_perkiraan,				
					"id_bayar_jenis"=> 10,
				]);					
			} 

			// 3. Create Setoran Awal
			$idRekening = array($idRekAsal,$insertRekening->id);
			$insertJB = JurnalBagian::create([
				"jurnal_no"=> $jurnalNo,
				"jurnal_keterangan"=> $keterangan,
				"jurnal_tanggal"=> date('Y-m-d', strtotime($this->date)),
				"jurnal_bagian"=> $bagian, 
				"kode_transaksi"=> "MO",  
				"mobile"=> "y",				
				"id_kelas"=> Session::get('kelas'),                        
				"dt_record"=> date("Y-m-d H:i:s"),
				"user_record"=> "Mobile : ".ucwords(strtolower(Session::get('nama')))
			]);
			
			if($insertJB) {
					
				for($a=0; $a<2; $a++){
					$insertDet = JurnalBagianDetail::create([
						"id_perkiraan"=> $idPerkiraan[$a],
						"id_jurnal_bagian"=> $insertJB->jurnal_bagian_id,
						"id_jenis_transaksi"=> $idJenisTransaksi[$a],
						"id_rekening"=> $idRekening[$a],
						"jurnal_det_nominal"=> $newNominal,
						"dt_record"=> date("Y-m-d H:i:s"),
						"user_record"=> "Mobile : ".ucwords(strtolower(Session::get('nama'))) 
					]);
				}
			}	
				
			if($insertDet) {
				DB::commit();				
				return response()->json([
					'status'=>'insert_successful',					
					'msg'=>' Nomor Rekening Anda : '.$nomorRekening,
					]);                    
			} else {
				return response()->json(['status'=>'insert_failed']);
			}
		} catch (\Throwable $e) {
			DB::rollback();            
			throw $e;            
			return response()->json(['status'=>'insert_failed']);
		}
		
    }
	
	public function successTabungan($param)
    {							
        $data = array(            
			'param' => ($param),   
			'header_title' => 'Pembukaan Rekening Berhasil',     
        );       
				
		return view($this->view.'success_tabungan', compact('data'));
    }
}
