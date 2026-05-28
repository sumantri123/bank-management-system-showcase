<?php

namespace App\Http\Controllers\mobileBanking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\TRekeningNasabah;
use App\Models\TRekeningAngsuranPinjaman;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use App\Models\mobileBanking\BayarHistory;
use Session;
use Carbon\Carbon;

class AngsuranMobileController extends Controller
{

    // use AuthenticatesUsers;
    protected $redirectTo = '/';

	public function __construct()
    {		
        //$this->middleware('guest', ['except' => ['logout', 'login_as']]);		
		$this->view = 'mobile/angsuran/';
		$this->yearNow = Carbon::now()->year;
		$this->date = Carbon::now()->format('m/d/Y');
		$this->when = Carbon::now();
		
    }
	
	public function index()
    {				
		$jenisRekening = array(4);
		$rekening = InitHelp::getRekening($jenisRekening);
		
        $data = array(  
			'rekening' => $rekening['rekening'],
			'saldo' => $rekening['saldo'],		
			'header_title' => 'Jenis Pinjaman',						
        );       
		
		return view($this->view.'index', compact('data'));
    }
		
	public function angsuran($id){
		
		$jenisRekening = array(1,2);
		$rekening = InitHelp::getRekening($jenisRekening);	            			
		$getPin = InitHelp::getPin();
		$dataAngsuranKe = InitHelp::getAngsuranKe($id);
		$kartuAngsuran = InitHelp::getKartuAngsuran($id);

		if($kartuAngsuran[0]->jenis_pinjaman == 1) {
			$jenisBayar = array(6);
		} elseif($kartuAngsuran[0]->jenis_pinjaman == 2){
			$jenisBayar = array(7);
		} else {
			$jenisBayar = array(8);
		}
		$getBiayaAdmin = InitHelp::getBiayaAdmin($jenisBayar);		
		
        $data = array(            
			'header_title' => 'Jenis Pinjaman',			
			'rekening' => $rekening['rekening'],
			'pinMobile' => base64_encode($getPin[0]->pin_mbanking),			
			'saldo' => $rekening['saldo'],
			'angsuranKe' => $dataAngsuranKe,			
			'kartuAngsuran' => $kartuAngsuran,
			'noRekPinjaman' => $kartuAngsuran[0]->nomor_rekening,
			'biayaAdmin' => $getBiayaAdmin[0]->bayar_biaya_admin,     
			'jenis' => base64_encode($jenisBayar[0]),     
        );       
		
		return view($this->view.'page_angsur', compact('data'));
	}
	
	public function dataAngsuran($id){
		
		$LNasabahIndividu = DB::table('t_rekening_pinjaman_angsuran as a')
        ->leftJoin('t_rekening_nasabah as b', 'a.id_rekening', '=', 'b.id') 
        ->select('a.*', 'b.nomor_rekening',)     
        ->where('pinjaman_angsuran_id','=',$id)            
        ->where('a.status','=',"n") 
        ->orderby('angsuran_ke','asc')
        ->limit(1)
        ->get();    
		
		if($LNasabahIndividu->isEmpty()) {
			return response()->json(['status'=>'null']);            
        } else { 
			$pecah = explode(".",$LNasabahIndividu[0]->nomor_rekening);
			//$ke = $pecah[2];
			$noRekening = $pecah[0].'.'.$pecah[1];
			$idRekening = $LNasabahIndividu[0]->id_rekening;

			if($pecah[0]==Session::get('1XXPIREG')){
				$idPerkiraanProvisi = Session::get('7XXBPINR_ID');
				$kodePerkiraanProvisi = Session::get('7XXBPINR');
				$idPerkiraanPinjaman = Session::get('1XXPIREG_ID');
				$kodePerkiraanPinjaman = Session::get('1XXPIREG');
				$jenisPinjaman = 2;

			} else if($pecah[0]==Session::get('1XXPIINS')){
				$idPerkiraanProvisi = Session::get('7XXBPINI_ID');
				$kodePerkiraanProvisi = Session::get('7XXBPINI');
				$idPerkiraanPinjaman = Session::get('1XXPIINS_ID');
				$kodePerkiraanPinjaman = Session::get('1XXPIINS');
				$jenisPinjaman = 1;

			} else {
				$idPerkiraanProvisi = Session::get('7XXPBUDI_ID');
				$kodePerkiraanProvisi = Session::get('7XXPBUDI');
				$idPerkiraanPinjaman = Session::get('1XXPIKAK_ID');
				$kodePerkiraanPinjaman = Session::get('1XXPIKAK');
				$jenisPinjaman = 3;
			}
			
			return response()->json([
                'status'=>'oke',                                
				'ke' => $LNasabahIndividu[0]->angsuran_ke,
                'angsuranPokok' => $LNasabahIndividu[0]->angsuran_pokok,
                'sukuBungaEfektif' => $LNasabahIndividu[0]->suku_bunga_efektif,
                'amortisasi' => $LNasabahIndividu[0]->amortisasi,                
                'totAngsur' => $LNasabahIndividu[0]->estimasi,
                'idAngsuran' => $LNasabahIndividu[0]->pinjaman_angsuran_id,
                'noRek' => $LNasabahIndividu[0]->nomor_rekening,
                'idPerkiraanProvisi' => $idPerkiraanProvisi,
                'idPerkiraanPinjaman' => $idPerkiraanPinjaman,
                'idRekening' => $idRekening,
                ]);            
		}		
	}
	
	public function storeAngsuran(Request $request)
    {       
        if($request->ajax()){          
            
            $jurnalNo = "MO-".time();                        						
			$bagian = "AT";
			$data = explode("|",($request->paramx));
			$idRek = $data[0];
			$idPer = $data[1];
			$saldo = $data[2];		
			$noRek = $data[3];
			$keterangan = "Pembayaran Angsuran Ke-".$request->angsuranKe.", No Rek : ".$request->no_rek_pin.', dari Rek : '.$noRek;			
			$nominal = $request->pembayaran_angsuran;
			$find = [",00","."];
			$replace = [""];
			$newNominal = str_replace($find, $replace, $nominal);
			$biaya = $request->biayaAdmin;

			DB::beginTransaction();
			try {
			
				$insert = JurnalBagian::create([
					"jurnal_no"=> $jurnalNo,
					"jurnal_keterangan"=> $keterangan,
					"jurnal_tanggal"=> date('Y-m-d', strtotime($this->date)),
					"jurnal_bagian"=> $bagian,    
					"kode_transaksi"=> "MO",
					"id_kelas"=> Session::get('kelas'),
					"dt_record"=> date("Y-m-d H:i:s"),
					"user_record"=>  "Mobile : ".ucwords(strtolower(Session::get('nama')))
				]);

				$update = TRekeningAngsuranPinjaman::where('pinjaman_angsuran_id', '=', $request->pinjaman_angsuran_id)->update([                              
					"status"=> "w",      
					"tanggal_bayar"=> date('Y-m-d'),
					"dt_modified"=> date("Y-m-d H:i:s"),
					"user_modified"=> "Mobile : ".ucwords(strtolower(Session::get('nama'))),
					"id_jurnal_bagian"=> $insert->jurnal_bagian_id
				]);  
								
				$idTransaksi = ["1","2"];
				$idPerkiraan = [$idPer,Session::get('309RPPIN_ID')];
				$idRekening = array($idRek,null);
				
				//Insert Jurnal Bagian Detail (Pinjaman)
				for($a=0; $a<count($idTransaksi); $a++) {                        

					$insertJBDet = JurnalBagianDetail::create([
						"id_perkiraan"=> $idPerkiraan[$a],
						"id_jurnal_bagian"=> $insert->jurnal_bagian_id,
						"id_jenis_transaksi"=> $idTransaksi[$a],
						"jurnal_det_nominal"=> $newNominal,
						"id_rekening"=> $idRekening[$a],                           
						"dt_record"=> date("Y-m-d H:i:s"),
						"user_record"=> "Mobile : ".ucwords(strtolower(Session::get('nama')))
					]);
				}                                
				
				$insertHistory = BayarHistory::create([
							"bayar_jenis"=> base64_decode($request->jenis_bayar),
							"bayar_keterangan"=> $keterangan,
							"bayar_no_pelanggan"=> $request->no_rek_pin,
							"id_nasabah"=> Session::get('idNasabah'),
							"id_jurnal_bagian"=> $insert->jurnal_bagian_id,								
							"bayar_pembelian"=> $newNominal,     						
							"bayar_admin"=> $biaya,     						
						]);

				$param = base64_encode($insertHistory->bayar_id);
				if($insertHistory) {
					DB::commit();
					return response()->json([
						'status'=>'insert_successful',
						'msg'=>($param)
					]);                
				} else {
					return response()->json(['status'=>'insert_failed','msg'=>'Insert Failed']);                
				}
			} catch (\Throwable $e) {
				DB::rollback();            
				throw $e;            
				return response()->json(['status'=>'insert_failed']);
			}

        } else {
            return redirect('asset/');
        }

    }

	public function successAngsuran($param)
    {							
		$getTransaksi = InitHelp::getTransaksi($param);
		
		$data1 = '';
		$data1 .= '<span class="heading"><u>Rekening Sumber</u></span><br>';
		$data1 .= '<small>'.Session::get('nama').'<br>'.Session::get('nama_bank').' : '.$getTransaksi[0]->nomor_rekening.'</small>';
		$data1 .= '<br><br>';
		
		$html = '';
		$html .= '<table class="styled-table">';
			$html .= '<tr height="40px">';
				$html .= '<th width="35%" style="text-align:left; padding: 10px;">Pembayaran</th>';
				$html .= '<td width="5%">:</td>';
				$html .= '<td width="" style="text-align:right; padding: 10px;">'.$getTransaksi[0]->bayar_jenis_nama.'</td>';
			$html .= '</tr>';
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">No. Rekening</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">'.$getTransaksi[0]->bayar_no_pelanggan.'</td>';
			$html .= '</tr>';
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">Nominal</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">Rp '.number_format($getTransaksi[0]->bayar_pembelian).'</td>';
			$html .= '</tr>';
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">Biaya Admin</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">Rp '.number_format($getTransaksi[0]->bayar_admin).'</td>';
			$html .= '</tr>';
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">Total</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">Rp '.number_format($getTransaksi[0]->jurnal_det_nominal).'</td>';
			$html .= '</tr>';
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">Status</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">Berhasil</td>';
			$html .= '</tr>';	
			$html .= '<tr height="40px">';
				$html .= '<th style="text-align:left; padding: 10px;">Keterangan</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">'.$getTransaksi[0]->bayar_keterangan.'</td>';
			$html .= '</tr>';			
		$html .= '</table>';
		
        $data = array(            			
			'header_title' => 'Pembayaran Berhasil',
			'transaksi' => $getTransaksi,
			'data1' => $data1,
			'html' => $html,
        );       
		
		return view('mobile/success_bayar', compact('data'));
    }
}
