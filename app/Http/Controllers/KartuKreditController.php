<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\GolonganDebitur;
use App\Models\Ikatan;
use App\Models\JenisAngunan;
use App\Models\LokasiDebitur;
use App\Models\JenisPenggunaan;
use App\Models\Penjamin;
use App\Models\PeriodeBayar;
use App\Models\PinjamanJaminan;
use App\Models\SektorEkonomi;
use App\Models\SifatKredit;
use App\Models\SumberDana;
use App\Models\TRekeningNasabah;
use App\Models\TRekeningPinjaman;
use App\Models\TRekeningAngsuranPinjaman;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use App\Models\EditPerkiraan;
use Session;
use Auth;

class KartuKreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index($kode)
    {		
        
        $LEditPerkiraan = EditPerkiraan::where('kode_perkiraan','like','309%')
						->where('id_lembaga', '=', Session::get('idLembaga'))
						->get(); 
		
        $LNasabahIndividu = DB::table('t_rekening_nasabah as a')
            ->leftJoin('m_nasabah', 'a.id_nasabah', '=', 'm_nasabah.id')            
            ->select('a.id as tab_id', 'a.bunga', 'a.id_perkiraan', 'a.tanggal_buka', 'a.jangka', 'a.jenis_pembayaran', 'a.nomor_rekening', 'a.id_nasabah', 'm_nasabah.*')                             
            ->where('a.id_kelas','=',Session::get('kelas'))  
            ->where('a.id_jenis_rekening','=','4')              
			->whereIn('a.id_pinjaman', [3]) 
            ->orderBy('a.id_jenis_rekening', 'asc')  
            ->orderBy('a.nomor_rekening', 'asc')       
            ->get();

        $data = array(
            'title' => 'Realisasi Kartu Kredit',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classFormSelect3' => 'single-select2',
            'classTable' => 'table table-sm table-bordered table-striped',
            'kode' => $kode            
        );         
                        
          
        $returnHTML = view('transaksi_kartu_kredit/index',
                        compact('data','LNasabahIndividu','LEditPerkiraan'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }    
    

    public function getDataNasabah(Request $request, $id)
    {           
        $LNasabahIndividu = DB::table('t_rekening_nasabah as a')
            ->leftJoin('m_nasabah', 'a.id_nasabah', '=', 'm_nasabah.id')            
            ->select('a.id as tab_id', 'a.bunga', 'a.id_perkiraan', 'a.tanggal_buka', 'a.jangka', 'a.jenis_pembayaran', 'a.id_pinjaman', 'a.nomor_rekening', 'a.id_nasabah', 'm_nasabah.nama', 'm_nasabah.alamat_ktp', 'm_nasabah.cif')
            ->where('a.id_kelas','=',Session::get('kelas'))  
            ->where('a.id','=',$id)  
            ->where('a.id_jenis_rekening','=','4')              
			->whereIn('a.id_pinjaman', [3]) 
            ->orderBy('a.id_jenis_rekening', 'asc')  
            ->orderBy('a.nomor_rekening', 'asc')       
            ->get();
        
		
		$dataTable = DB::select(
            
			DB::raw('
                SELECT nomor_rekening, d.id_jenis_transaksi, d.id_perkiraan,
				sum(case when d.id_jenis_transaksi = 1 THEN jurnal_det_nominal else 0 END) as Debit,
				sum(case when d.id_jenis_transaksi = 2 THEN jurnal_det_nominal else 0 END) as Kredit
                FROM t_rekening_nasabah  as c
				LEFT JOIN m_nasabah as a on c.id_nasabah = a.id
				LEFT JOIN t_jurnal_bagian_detail as d on c.id = d.id_rekening
				LEFT JOIN t_jurnal_bagian as e on d.id_jurnal_bagian = e.jurnal_bagian_id
                WHERE c.id = "'.$id.'"
				and d.id_perkiraan = '.Session::get('1XXPIKAK_ID').'
				group by id_perkiraan, d.id_jenis_transaksi, nomor_rekening
				order by id_jenis_transaksi asc
            ')
        );
		
        $pecah = explode(".",$LNasabahIndividu[0]->nomor_rekening);
        $ke = substr($pecah[1],-1); 
        $rekeningKode = substr($pecah[1],0,4); 
        $noRekening = $pecah[0].'.'.$rekeningKode;
		$debit = isset($dataTable[0]->Debit) ? $dataTable[0]->Debit : 0;
		$kredit = isset($dataTable[1]->Kredit) ? $dataTable[1]->Kredit : 0;
        $sisaKredit = 10000000 - $debit + $kredit;
		
		//$idPerkiraanProvisi = Session::get('7XXPPKAK_ID');
		$idPerkiraanProvisi = Session::get('7XXPDIME_ID');
		//$kodePerkiraanProvisi = Session::get('7XXPPKAK');
		$kodePerkiraanProvisi = Session::get('7XXPDIME');
		$jenisPinjaman = 3;
			        
        if($LNasabahIndividu->isEmpty()) {
            return response()->json(['status'=>'null']);            
        } else {
            return response()->json([
                'status'=>'oke',
                'idPer' => $LNasabahIndividu[0]->id_perkiraan,
                'nama' => $LNasabahIndividu[0]->nama,
                'alamat' => $LNasabahIndividu[0]->alamat_ktp,
                'idNasabah' => $LNasabahIndividu[0]->id_nasabah,
                'noRekening' => $noRekening,
                'idPerkiraanProvisi' => $idPerkiraanProvisi,
                'kodePerkiraanProvisi' => $kodePerkiraanProvisi,
                'idPinjaman' => $LNasabahIndividu[0]->id_pinjaman,
                'jenisPinjaman' => $jenisPinjaman,
                'cif' => $LNasabahIndividu[0]->cif,
				'sisaKredit' => $sisaKredit,
                'ke' => $ke,
                ]);            
        }
    }

    
    public function getIdPerkiraan2(Request $request, $id)
    {   
        $LEditPerkiraan = EditPerkiraan::where('id','=',$id)
						->where('id_lembaga', '=', Session::get('idLembaga'))
						->get();     
        
        if($LEditPerkiraan->isEmpty()) {
            return response()->json(['status'=>'null']);            
        } else {
            return response()->json([
                'status'=>'oke',
                'kodePerkiraan' => $LEditPerkiraan[0]['kode_perkiraan'],
                'idPerkiraan' => $LEditPerkiraan[0]['id']
                ]);            
        }

    }

    private function validateRequest($request, $id=0){

        $messages = [
            'required' => 'Kolom <b>:attribute</b> harus diisi.',
            'min' => 'Panjang minimal <b>:attribute</b> huruf.',
            'numeric' => 'Inputan harus angka.',
            'unique' => 'Data <b>:attribute</b> ":input" sudah ada, tidak boleh sama.',
        ];

        return Validator::make($request->all(), [
//            "nomor_rekening" => "required|unique:t_rekening_nasabah,nomor_rekening".($id ? ",".$id.",id" : "" ),            
        ], $messages);
    }

    public function store(Request $request)
    {        

        if($request->ajax()){
            // if ($this->validateRequest($request)->fails()) {
			// 	return response()->json([
            //         'status'=>'insert_failed',
            //         'error' => $this->validateRequest($request)->messages()
            //         ]);

            // }                                                                    
            
            $bagianGrup = array("JM","JX","AK","CS","PB","JD","TF","JG","LA","AT");
            $bagian = base64_decode($request->bagian);
			$plafonKredit = str_replace(array(","),"",$request->pokok_plafon);
			$provisiKredit = str_replace(array(".",",00"),"",$request->provisi_nominal);

            $buktiDroping = $request->bukti_droping;             

            // Cek Jurnal Nomer            
            $cekData = DB::table('t_jurnal_bagian as a')                  
                ->select('a.*')
                ->where('a.id_kelas','=',Session::get('kelas'))  
                ->where('a.jurnal_bagian','=',$bagian)  
                ->where('a.kode_transaksi','=','RP')  
                ->where('a.jurnal_tanggal','=',date('Y-m-d', strtotime($request->tgl)))  
				->where('a.jurnal_no','=',$buktiDroping)                  
                ->count();

            if(($cekData)>0){
                return response()->json(['status'=>'insert_failed','msg'=>' Nomer Bukti Sudah Ada, Gunakan Nomer Yang Lain']); 
            
            } else if ($plafonKredit > $request->sisa_kredit_val){
				return response()->json(['status'=>'insert_failed','msg'=>' Maksimal Kredit Hanya Rp. '.number_format($request->sisa_kredit_val)]); 
			} else if(in_array($bagian, $bagianGrup)) {
                                  
                $kodePerkiraan = $request->kode_perkiraan;                
                $pattern = substr($kodePerkiraan,-3); 

                if($pattern=="000"){

                    return response()->json(['status'=>'insert_failed','msg'=>'Tidak Diperbolehkan Menggunakan Kode Perkiraan 000']);
                    
                } else {

                    // Cek Apakah Sudah Pernah Direalisasi
                    /* $cekTfRekening = DB::table('t_jurnal_bagian_detail as a')   
                    ->leftJoin('t_rekening_nasabah as b', 'a.id_rekening', '=', 'b.id')                           
                    ->select('a.*')
                    ->where('b.id_kelas','=',Session::get('kelas'))  
                    ->where('b.nomor_rekening','=',$request->no_rekening.$request->ke)
					->whereIn('id_pinjaman', [1,2])                                  
                    ->count();  */      

                    //if($cekTfRekening==0){

                        DB::beginTransaction();

                        try {
                                                        
							$idRekening = $request->id_rekening2; 
							
                            // Insert di Tabel Pinjaman
                            /* $insertPinjaman = TRekeningPinjaman::create([
                                "jenis_pinjaman"=> $request->jenis_pinjaman,  
                                "id_rekening"=> $idRekening,                                                          
                                "tanggal_realisasi"=> $request->tgl,                                 
                                "nominal_pokok"=> str_replace(array(","),"",$request->pokok_plafon),                                 
                                "provisi_persen"=> $request->provisi_persen, 
                                "provisi_nominal"=> str_replace(array(".",",00"),"",$request->provisi_nominal),                                                                
                                "id_perkiraan_provisi"=> $request->id_perkiraan_provisi,                                 
                                "id_perkiraan_dropping"=> $request->id_perkiraan1,
                                "id_perkiraan_lawan"=> $request->rek_lawan_perk,
                                "bukti_dropping"=> $request->bukti_droping,                                 
                                "id_kelas"=> Session::get('kelas'),                        
                                "dt_record"=> date("Y-m-d H:i:s"),
                                "user_record"=> Session::get('login_as')       
                            ]);    */
							

							$ket = [$request->id_perkiraan1,$request->rek_lawan_perk,$request->id_perkiraan_provisi];                            
                            $jurnalKeterangan = "Realisasi ".$request->no_rekening.'.'.$request->ke.' '.$request->nama;
                            $nominal = [str_replace(array(","),"",$request->pokok_plafon),str_replace(array(".",",00"),"",$request->provisi_nominal)];                   							
							
							//Insert Jurnal Bagian (Pinjaman)							
							$insertJB = JurnalBagian::create([
								"jurnal_no"=> $request->bukti_droping,
								"jurnal_tanggal"=> date('Y-m-d'),                            
								"jurnal_bagian"=> $bagian,  
								"kode_transaksi"=> "RP",                   
								"jurnal_keterangan"=> $jurnalKeterangan,
								"discount_merchant"=> $request->provisi_persen,
								"id_kelas"=> Session::get('kelas'),                        
								"dt_record"=> date("Y-m-d H:i:s"),
								"user_record"=> Session::get('login_as')           
							]);  
							
							$loop = 3;
							$idJnsTransaksiKredit = [1,2,2];							
							$plafonNett = $plafonKredit - $provisiKredit;
							$nominalKredit = [$plafonKredit,$plafonNett,$provisiKredit];
							
							for($b=0; $b<$loop; $b++){
								
								//Insert Jurnal Bagian Detail (Pinjaman)
								$insertJBDet1 = JurnalBagianDetail::create([
									"id_perkiraan"=> $ket[$b],
									"id_jurnal_bagian"=> $insertJB->jurnal_bagian_id,
									"id_jenis_transaksi"=> $idJnsTransaksiKredit[$b],
									"jurnal_det_nominal"=> $nominalKredit[$b],
									"id_rekening"=> $idRekening,                           
									"dt_record"=> date("Y-m-d H:i:s"),
									"user_record"=> Session::get('login_as'),
								]);
							}	
							
							$idJb = $insertJB->jurnal_bagian_id;							
                            
                            if($insertJBDet1) {
                                DB::commit();
                                return response()->json(
                                    [
                                        'status'=>'insert_successful',
                                        /* 'id'=>$insertPinjaman->rekening_pinjaman_id, */
										'id'=>'',
                                        'idRek'=>$idRekening,
                                        'idJb0'=>$idJb,                                        
                                    ]);                
                            } else {
                                return response()->json(['status'=>'insert_failed','msg'=>'Insert Failed']);                
                            }
                            
                        } catch (\Throwable $e) {

                            DB::rollback();            
                            throw $e;            
                            return response()->json(['status'=>'insert_failed']);
            
                        }

                    /* } else {
                        return response()->json(['status'=>'insert_failed','msg'=>' Rekening Sudah Pernah Direalisasi']);                    
                    } */
                    
                }
                
            } else {
                return response()->json(['status'=>'insert_failed','msg'=>' Akses Ditolak, Silahkan Refresh Halaman']);                
            }            

        } else {
            return redirect('asset/');
        }

    }
    
    public function destroy(Request $request)
    {

		if($request->ajax()){

			DB::beginTransaction();

			try {

				/* $query = TRekeningPinjaman::find($request->idRekPin)->delete(); */
				$query2 = JurnalBagian::find($request->idJb0)->delete();								

				if($query2) {
					DB::commit();
					return response()->json(['status'=>'delete_successful']);
				} else {
					return response()->json(['status'=>'delete_failed']);
				}
			} catch (\Throwable $e) {

				DB::rollback();    
				throw $e;
				return response()->json(['status'=>'insert_failed']);
			}

		} else {
			return response()->json(['status'=>'delete_failed']);
		}           
               
    }
    
    public function search(Request $request)
    {   
        $search = $request->search;

        if($search != ''){            			
			
			$searchData = DB::table('t_jurnal_bagian as a')
            ->leftJoin('t_jurnal_bagian_detail as b', 'a.jurnal_bagian_id', '=', 'b.id_jurnal_bagian')
            ->leftJoin('m_perkiraan as c', 'b.id_perkiraan', '=', 'c.id')
            ->leftJoin('t_rekening_nasabah as d', 'b.id_rekening', '=', 'd.id')
			->leftJoin('m_nasabah as e', 'd.id_nasabah', '=', 'e.id')            
            ->select('a.*', 'b.*', 'c.kode_perkiraan','c.nama_perkiraan','d.nomor_rekening','d.id as id_rekening','e.nama','e.alamat_ktp')            
            ->where('jurnal_no', '=', $search)
            ->where('a.id_kelas', '=', Session::get('kelas'))            
			->where('c.id_lembaga','=',Session::get('idLembaga'))
            ->where('jurnal_tanggal','=',date('Y-m-d'))
            ->get();
        }
		
        $response = array();
		if($search==''){
			$response[] = array("status"=>"failed","value"=>"0","label"=>"Note : Tidak Ada Data");
		}elseif($searchData->isEmpty()) {
			$response[] = array("status"=>"failed","value"=>"0","label"=>"Note : Tidak Ada Data");
        } else {
            foreach($searchData as $LSearchData){
                $response[] = array(
					"status"=>"oke",
                    "label"=>$LSearchData->nomor_rekening.' - '.$LSearchData->nama,
                    "data"=>$LSearchData,                    
                );
            }
        }

        return response()->json($response);              
    }
}
