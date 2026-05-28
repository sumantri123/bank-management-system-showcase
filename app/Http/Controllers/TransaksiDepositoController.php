<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\EditPerkiraan;
use App\Models\TRekeningNasabah;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use Session;
use Auth;

class TransaksiDepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index($kode)
    {		
        $LNasabahIndividu = DB::table('t_rekening_nasabah as a')
            ->leftJoin('m_nasabah', 'a.id_nasabah', '=', 'm_nasabah.id')                        
            ->select('a.id as tab_id', 'a.bunga', 'a.id_perkiraan', 'a.tanggal_buka', 'a.jangka', 'a.jenis_pembayaran', 'a.nomor_rekening', 'a.id_nasabah', 'm_nasabah.*')            
            ->where('id_jenis_rekening','=',3)
            ->where('a.id_kelas','=',Session::get('kelas'))            
            ->get();  
                
        $LEditPerkiraan = EditPerkiraan::where('kode_perkiraan','like','309%')
						->where('id_lembaga','=',Session::get('idLembaga'))
						->get();           

        $data = array(
            'title' => 'Buka / Tutup Deposito',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classFormSelect3' => 'single-select2',
            'classTable' => 'table table-sm table-bordered table-striped',            
            'kode' => $kode
        );         
                
        //return view('transaksi_deposito/index', compact('data','LEditPerkiraan','LNasabahIndividu'));        
        $returnHTML = view('transaksi_deposito/index',compact('data','LEditPerkiraan','LNasabahIndividu'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
        
    }        

    // public function getDataDep(Request $request)
    // {   

    //     $LTRekeningNasabah = DB::table('t_jurnal_bagian_detail as a')
    //         ->leftJoin('t_rekening_nasabah as b', 'a.id_rekening', '=', 'b.id')            
    //         ->select('b.id as tab_id', 'a.jurnal_det_nominal')            
    //         ->where('id_jenis_rekening','=',3)
    //         ->where('id_rekening','=',$request->idRek)
    //         ->where('b.id_kelas','=',Session::get('kelas'))            
    //         ->get();         
        
    //     if($LTRekeningNasabah->isEmpty()) {
    //         return response()->json(['status'=>'null']);            
    //     } else {
    //         return response()->json([
    //             'status'=>'oke',
    //             'saldoDep' => $LTRekeningNasabah[0]->jurnal_det_nominal,
    //             ]);            
    //     }

    // }

    // public function getDepPerkiraan(Request $request, $id)
    // {   
    //     $LEditPerkiraan = EditPerkiraan::where('kode_perkiraan','=',$id)->get();     
        
    //     if($LEditPerkiraan->isEmpty()) {
    //         return response()->json(['status'=>'null']);            
    //     } else {
    //         return response()->json([
    //             'status'=>'oke',
    //             'data' => $LEditPerkiraan[0]['id'],
    //             'kode' => $LEditPerkiraan[0]['kode_perkiraan']
    //             ]);            
    //     }

    // }    

    public function getIdPerkiraan1(Request $request, $id)
    {   
       // $LTRekeningNasabah = TRekeningNasabah::where('id','=',$id)->get(); 
        
        $LTRekeningNasabah = DB::table('t_rekening_nasabah as a')
            ->leftJoin('m_nasabah as b', 'a.id_nasabah', '=', 'b.id')            
            ->leftJoin('m_perkiraan as c', 'a.id_perkiraan', '=', 'c.id')
            ->leftJoin('t_jurnal_bagian_detail as d', 'a.id', '=', 'd.id_rekening')
            ->select('nama','nomor_rekening','a.id_perkiraan','jurnal_det_nominal','kode_perkiraan','nama_perkiraan')            
            ->where('id_jenis_rekening','=',3)
            ->where('a.id','=',$id)            
            ->where('a.id_kelas','=',Session::get('kelas')) 
			->where('c.id_lembaga','=',Session::get('idLembaga'))
            ->get(); 
        
        if($LTRekeningNasabah->isEmpty()) {
            return response()->json(['status'=>'null']);            
        } else {
            return response()->json([
                'status'=>'oke',
                'idPerkiraan' => $LTRekeningNasabah[0]->id_perkiraan,
                'noRekening' => $LTRekeningNasabah[0]->nomor_rekening,
                'kodePerkiraan' => $LTRekeningNasabah[0]->kode_perkiraan,
                'namaPerkiraan' => $LTRekeningNasabah[0]->nama_perkiraan,
                'saldoDeposito' => $LTRekeningNasabah[0]->jurnal_det_nominal,
                'nama' => $LTRekeningNasabah[0]->nama
                ]);            
        }

    }

    public function getIdPerkiraan2(Request $request, $id)
    {   
        $LEditPerkiraan = EditPerkiraan::where('id','=',$id)
						->where('id_lembaga','=',Session::get('idLembaga'))
						->get();     
        
        if($LEditPerkiraan->isEmpty()) {
            return response()->json(['status'=>'null']);            
        } else {
            return response()->json([
                'status'=>'oke',
                'kodePerkiraan' => $LEditPerkiraan[0]['kode_perkiraan'],
                'namaPerkiraan' => $LEditPerkiraan[0]['nama_perkiraan']
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

            $jurnalNo = $request->no_bukti;
            $nomer = $jurnalNo;           

            $bagianGrup = array("JM","JX","AK","CS","PB","JD","TF","JG","LA","AT");
            $bagian = base64_decode($request->bagian);

            $cekData = JurnalBagian::where([
                ['jurnal_no','=',$nomer],
                ['jurnal_bagian','=',$bagian],
                ['kode_transaksi','=','TD'],
                ['jurnal_tanggal','=',date('Y-m-d', strtotime($request->tgl))],
                ['id_kelas','=',Session::get('kelas')],
            ])->count();            

            // cek saldo deposito
            $LTRekeningNasabah = DB::table('t_jurnal_bagian_detail as a')
				->leftJoin('t_jurnal_bagian as c', 'a.id_jurnal_bagian', '=', 'c.jurnal_bagian_id')            
                ->leftJoin('t_rekening_nasabah as b', 'a.id_rekening', '=', 'b.id')            
                ->select('b.id as tab_id', 'a.jurnal_det_nominal')            
                ->where('id_jenis_rekening','=',3)
                ->where('id_rekening','=',$request->id_rekening)
                ->where('b.id_kelas','=',Session::get('kelas')) 
				->where('c.mobile','=','n')				
                ->get();              
            
            $saldoAwal = (count($LTRekeningNasabah)>0)? $LTRekeningNasabah[0]->jurnal_det_nominal:0;

            if(($cekData)>0){
                return response()->json(['status'=>'insert_failed','msg'=>' Nomer Bukti Sudah Ada, Gunakan Nomer Yang Lain']); 

            } else if((($saldoAwal)>0) && (($request->id_transaksi)==2)){ // cek penempatan
                return response()->json(['status'=>'insert_failed','msg'=>' Nominal Sudah Pernah Diinputkan']); 

            } else if((($saldoAwal)==0) && (($request->id_transaksi)==1)){ // cek pencairan
                return response()->json(['status'=>'insert_failed','msg'=>' Nominal Belum Pernah Diinputkan']); 

            } else if(in_array($bagian, $bagianGrup)){
                
                $pecah2 = explode('-',$request->rek_lawan_perk);
                $kodePerkiraan = $request->kode_perkiraan2;                
                $pattern = substr($kodePerkiraan,-3);                

                if($pattern=="000"){

                    return response()->json(['status'=>'insert_failed','msg'=>'Tidak Diperbolehkan Menggunakan Kode Perkiraan 000']);

                }else {
                    
                    DB::beginTransaction();
                    try {
                        $insert = JurnalBagian::create([
                            "jurnal_no"=> $jurnalNo,
                            "jurnal_keterangan"=> $request->keterangan,
                            "jurnal_tanggal"=> date('Y-m-d', strtotime($request->tgl)),
                            "jurnal_bagian"=> $bagian,      
                            "kode_transaksi"=> "TD",                              
                            "id_kelas"=> Session::get('kelas'),                        
                            "dt_record"=> date("Y-m-d H:i:s"),
                            "user_record"=> Session::get('login_as')
                        ]);
        
                        if($insert) {
        
                            $nominal = $request->nominal;
                            $find = [","];
                            $replace = [""];
                            $newNominal = str_replace([","], $replace, $nominal);//---untuk menghilangkan koma
							//$newNominal = str_replace(["."], $replace, $newNominal);//---untuk menghilangkan titik
							
                            $idTransaksi2 = ($request->id_transaksi == 1) ? 2:1;                    
                                                
                            $insertDet1 = JurnalBagianDetail::create([
                                "id_perkiraan"=> $request->id_perkiraan1,
                                "id_jurnal_bagian"=> $insert->jurnal_bagian_id,
                                "id_jenis_transaksi"=> $request->id_transaksi,
                                "id_rekening"=> $request->id_rekening,
                                "jurnal_det_nominal"=> $newNominal,
                                "dt_record"=> date("Y-m-d H:i:s"),
                                "user_record"=> Session::get('login_as')
                            ]);
        
                            // entry rekening lawan
                            $insertDet = JurnalBagianDetail::create([
                                "id_perkiraan"=> $request->rek_lawan_perk,
                                "id_rekening"=> $request->id_rekening,
                                "id_jurnal_bagian"=> $insert->jurnal_bagian_id,
                                "id_jenis_transaksi"=> $idTransaksi2,
                                "jurnal_det_nominal"=> $newNominal,
                                "dt_record"=> date("Y-m-d H:i:s"),
                                "user_record"=> Session::get('login_as'),   
                            ]);
                            
        
                            if($insertDet) {
                                DB::commit();
                                return response()->json([
                                    'status'=>'insert_successful',
                                    'id'=>$insert->jurnal_bagian_id,
                                    'jbNo'=>$jurnalNo,
                                    'jbTgl'=>date('Y-m-d', strtotime($request->tgl)),
                                    'jbNoRekening'=>$request->no_rekening,
                                    'jbIdTransaksi'=>$request->id_transaksi,
                                    'jbIdTransaksi1'=>$idTransaksi2,                                
                                    'jbNominal'=>$newNominal,
                                    'jbSaldoAwal'=>$saldoAwal,
                                    'jbNama'=>$request->nama,
                                    'jbRekKodeLawan'=> $request->kode_perkiraan1,
                                    'jbRekNamaPer'=> $request->nama_perkiraan1,                               
                                    'jbRekKodeLawan1'=> $request->kode_perkiraan2,               
                                    'jbRekNamaPer1'=> $request->nama_perkiraan2,                                
                                    ]);                
                            } else{
                                return response()->json(['status'=>'insert_failed','msg'=>'Insert Failed']);    
                            }
                        } else {
                            return response()->json(['status'=>'insert_failed','msg'=>'Insert Failed']);
                        }
                    } catch (\Throwable $e) {
                        DB::rollback();            
                        throw $e;            
                        return response()->json(['status'=>'insert_failed']);
                    }
                }   

            } else {
                return response()->json(['status'=>'insert_failed','msg'=>' Akses Ditolak, Silahkan Refresh Halaman']);                
            }

        } else {
            return redirect('asset/');
        }

    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            if ($this->validateRequest($request, $id)->fails()) {

                // return response()->json([
                //     'status'=>'insert_failed',
                //     'error' => $this->validateRequest($request, $id)->messages()
                //     ]);
            }            
            

            $bagianGrup = array("JM","JX","AK","CS","PB","JD","TF","JG","LA","AT");
            $bagian = base64_decode($request->bagian);                        
            
            $nominal = $request->nominal;
            $find = [","];
            $replace = [""];
            $newNominal = str_replace($find, $replace, $nominal);

            $update = JurnalBagian::where('jurnal_bagian_id', '=', $id)->update([                              
                "jurnal_keterangan"=> $request->keterangan,
                "jurnal_tanggal"=> date('Y-m-d', strtotime($request->tgl)),
                "jurnal_bagian"=> $bagian,                
                "id_kelas"=> Session::get('kelas'),
                "dt_modified"=> date("Y-m-d H:i:s"),
                "user_modified"=> Session::get('login_as')
            ]);

            
            if($update) {
                return response()->json([
                    'status'=>'insert_successful',
                    'id'=>$id,
                    'jbNo'=>$request->no_bukti,
                    'jbTgl'=>date('Y-m-d', strtotime($request->tgl)),
                    'jbNoRekening'=>$request->no_rekening,
                    'jbIdTransaksi'=>$request->id_transaksi,
                    'jbNominal'=>$newNominal,
                    ]);                                
            } else {
                return response()->json(['status'=>'insert_failed']);
            }
        } else {
            return response()->json(['status'=>'proses_failed']);
        }

    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $query = JurnalBagian::find($id)->delete();
            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return response()->json(['status'=>'delete_failed']);
        }
    }    

    public function search(Request $request)
    {   
        $bagian = base64_decode($request->bagian);
        $search = $request->kode;

        $searchData = DB::table('t_jurnal_bagian as a')
            ->leftJoin('t_jurnal_bagian_detail as b', 'a.jurnal_bagian_id', '=', 'b.id_jurnal_bagian')
            ->leftJoin('m_perkiraan as c', 'b.id_perkiraan', '=', 'c.id')
            ->leftJoin('t_rekening_nasabah as d', 'b.id_rekening', '=', 'd.id')
            ->leftJoin('m_nasabah as e', 'd.id_nasabah', '=', 'e.id')
            ->leftJoin('m_perkiraan as f', 'b.id_perkiraan', '=', 'f.id')
            ->select('a.*', 'b.*', 'c.kode_perkiraan','c.nama_perkiraan','f.nama_perkiraan','d.nomor_rekening','e.nama')            
            ->where('jurnal_no', '=', $search)
            ->where('a.id_kelas', '=', Session::get('kelas'))
			->where('f.id_lembaga', '=', Session::get('idLembaga'))
            ->where('jurnal_bagian','=',$bagian)
            ->where('a.kode_transaksi', '=', 'TD')
            ->where('jurnal_tanggal','=',date('Y-m-d'))
            ->get();

        if(count($searchData)>0) {
            return response()->json([
                'status'=>'oke',
                'jbId'=> $searchData[0]->jurnal_bagian_id,
                'jbNo'=> $searchData[0]->jurnal_no,
                'jbKet'=> $searchData[0]->jurnal_keterangan,
                'jbTgl'=> $searchData[0]->jurnal_tanggal,
                'jbBag'=> $searchData[0]->jurnal_bagian,
                'jbNominal'=> $searchData[0]->jurnal_det_nominal,
                'jbIdRekening'=> $searchData[0]->id_rekening,
                'jbIdPerkiraan1'=> $searchData[0]->id_perkiraan,
                'jbIdTransaksi'=> $searchData[0]->id_jenis_transaksi,                
                'jbNoRekening'=> $searchData[0]->nomor_rekening,                
                'jbNama'=> $searchData[0]->nama,
                'jbRekKodeLawan'=> $searchData[0]->kode_perkiraan,
                'jbRekNamaPer'=> $searchData[0]->nama_perkiraan,
                'jbIdTransaksi1'=> $searchData[1]->id_jenis_transaksi,
                'jbRekLawan'=> $searchData[1]->id_perkiraan,
                'jbRekKodeLawan1'=> $searchData[1]->kode_perkiraan,                
                'jbRekNamaPer1'=> $searchData[1]->nama_perkiraan,
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }                
    }
}
