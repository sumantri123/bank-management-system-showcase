<?php

namespace App\Http\Controllers\mobileBanking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use DB;
use Carbon\Carbon;

class BpjsController extends Controller
{

    // use AuthenticatesUsers;
    protected $redirectTo = '/';

	public function __construct()
    {		
        //$this->middleware('guest', ['except' => ['logout', 'login_as']]);
		$this->yearNow = Carbon::now()->year;
		$this->date = Carbon::now()->format('m/d/Y');
		$this->when = Carbon::now();
		$this->view = 'mobile/bpjs/';
		
    }
	
	public function index()
    {	
		$jenisRekening = array(1,2);
		$rekening = InitHelp::getRekening($jenisRekening);	
		$getPin = InitHelp::getPin();			
		$jenisBayar = array(5);
		$getBiayaAdmin = InitHelp::getBiayaAdmin($jenisBayar);	
        $data = array(            
			'header_title' => 'BPJS Kesehatan',			
			'rekening' => $rekening['rekening'],
			'pinMobile' => base64_encode($getPin[0]->pin_mbanking),			
			'saldo' => $rekening['saldo'],
			'biayaAdmin' => $getBiayaAdmin[0]->bayar_biaya_admin,     			
        );       
		
		return view($this->view.'index', compact('data'));
    }

	public function successBayarBpjs($param)
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
				$html .= '<th style="text-align:left; padding: 10px;">No. Pelanggan</th>';
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
				$html .= '<th style="text-align:left; padding: 10px;">Periode</th>';
				$html .= '<td>:</td>';
				$html .= '<td style="text-align:right; padding: 10px;">'.date('F Y',strtotime($getTransaksi[0]->dt_record)).'</td>';
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
