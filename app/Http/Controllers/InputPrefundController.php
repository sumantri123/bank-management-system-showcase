<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\EditPerkiraan;
use App\Models\DaftarKliring;
use App\Models\JurnalBagian;
use App\Models\JurnalRTGS;
use App\Models\JurnalBagianDetail;
use Session;
use Auth;

class InputPrefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {		
        $LEditPerkiraan = EditPerkiraan::where('kode_perkiraan','like','830%')
						->where('id_lembaga','=',Session::get('idLembaga'))
						->get();
						
        $LDaftarKliringBA = DaftarKliring::where('id_lembaga','=',Session::get('idLembaga'))->get();
		
        $data = array(
            'title' => 'Input Prefund / RTGS',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classTable' => 'table table-sm table-bordered table-striped',            
        );         
                        
        //return view('prefund/index', compact('data','LEditPerkiraan','LDaftarKliringBA'));        
        $returnHTML = view('prefund/index',compact('data','LEditPerkiraan','LDaftarKliringBA'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
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
                'idPerkiraan' => $LEditPerkiraan[0]['id']
                ]);            
        }
    }

    public function getKodeKliring(Request $request)
    {   
        $search = $request->kode_kliring;

        if($search == ''){

            $LSearchData = DaftarKliring::where('id_lembaga','=',Session::get('idLembaga'))->limit(7)->get();
                                                    
        }else{     

            $LSearchData = DaftarKliring::where('kode_kliring', 'like', $search . '%')
						->where('id_lembaga','=',Session::get('idLembaga'))
						->limit(7)
						->get();
            
        }

        $response = array();
        if($LSearchData->isEmpty()) {
                $response[] = array("value"=>"0","label"=>"Note : Tidak Ada Data");
        } else {
            foreach($LSearchData as $LSearchData){
                $response[] = array(
                    "value"=>$LSearchData->id,
                    "label"=>$LSearchData->kode_kliring.' - '.$LSearchData->nama_kliring,
                    "data"=>$LSearchData,
                );
            }
        }

        return response()->json($response);              
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
            
            //$bagianGrup = array("JM","JX","AK","CS","PB","JD","TF","JG","LA","AT");
            //$bagian = base64_decode($request->bagian);
            $bagian = "TF";

            $cekData = JurnalBagian::where([
                ['jurnal_no','=',$jurnalNo],
                ['jurnal_bagian','=',$bagian],
                ['kode_transaksi','=','KR'],
                ['jurnal_tanggal','=',date('Y-m-d', strtotime($request->tgl))],
                ['id_kelas','=',Session::get('kelas')],
            ])->count();
                        
            if(($cekData)>0){
                return response()->json(['status'=>'insert_failed','msg'=>' Nomer Bukti Sudah Ada, Gunakan Nomer Yang Lain']);                     

            } else {
                DB::beginTransaction();
                try {
                
                    $insertJB = JurnalBagian::create([
                        "jurnal_no"=> $jurnalNo,
                        "jurnal_keterangan"=> $request->payment_detail,
                        "jurnal_tanggal"=> date('Y-m-d', strtotime($request->tgl)),
                        "jurnal_bagian"=> $bagian, 
                        "kode_transaksi"=> "KR",                    
                        "id_kelas"=> Session::get('kelas'),
                        "dt_record"=> date("Y-m-d H:i:s"),
                        "user_record"=> Session::get('login_as')
                    ]);
                    
                    //Insert Jurnal Bagian Detail (Pinjaman)
                    // id perkiraan pada BI (6 ; 102001)
                    $idPerkiraan = array($request->rek_lawan_perk,Session::get('1XXGIRBI_ID'));
                    $idTransaksi = array(1,2);
                    for($a=0; $a<2; $a++) {                        

                        $insertJBDet = JurnalBagianDetail::create([
                            "id_perkiraan"=> $idPerkiraan[$a],
                            "id_jurnal_bagian"=> $insertJB->jurnal_bagian_id,
                            "id_jenis_transaksi"=> $idTransaksi[$a],
                            "jurnal_det_nominal"=> str_replace(",","",$request->nominal),
                            "dt_record"=> date("Y-m-d H:i:s"),
                            "user_record"=> Session::get('login_as'),   
                        ]);
                    }                                

                    $insertRTGS = JurnalRTGS::create([
                        "jurnal_rtgs_no"=> $jurnalNo,
                        "jurnal_rtgs_tanggal"=> date('Y-m-d', strtotime($request->tgl)),
                        "id_jurnal_bagian"=> $insertJB->jurnal_bagian_id,
                        "kode_from_member"=> $request->from_member,
                        "kode_to_member"=> $request->to_member,
                        "id_kliring_by_order"=> $request->id_kliring,
                        "id_kliring_kode_prefund"=> $request->rek_lawan_perk,
                        "payment_detail"=> $request->payment_detail,
                        "member_information"=> $request->member_information,
                        "kode_sender_ref"=> $request->send_ref,
                        "kode_receiver_ref"=> $request->receiver_ref,
                        "id_kelas"=> Session::get('kelas'),                        
                        "dt_record"=> date("Y-m-d H:i:s"),
                        "user_record"=> Session::get('login_as')       
                    ]);

                    if($insertRTGS) {
                        DB::commit();
                        return response()->json(['status'=>'insert_successful','idJb'=>$insertJB->jurnal_bagian_id,'idRtgs'=>$insertRTGS->jurnal_rtgs_id]);                
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
            return redirect('asset/');
        }

    }    

    public function destroy(Request $request)
    {
        if($request->ajax()){
                        
            $query = JurnalBagian::find($request->id)->delete();
            //$query1 = JurnalRTGS::find($request->idRtgs)->delete();
            
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
        //$bagianGrup = array("JM","JX","AK","CS","PB","JD","TF","JG","LA","AT");
        //$bagian = base64_decode($request->bagian);
        $bagian = "TF";
        $search = $request->kode;

        $searchData = DB::table('t_jurnal_bagian_rtgs as a')
            ->leftJoin('t_jurnal_bagian as c', 'a.id_jurnal_bagian', '=', 'c.jurnal_bagian_id')
            ->leftJoin('t_jurnal_bagian_detail as b', 'c.jurnal_bagian_id', '=', 'b.id_jurnal_bagian')
            ->leftJoin('m_daftar_kliring as d', 'a.id_kliring_by_order', '=', 'd.id')
            ->leftJoin('m_perkiraan as e', 'a.id_kliring_kode_prefund', '=', 'e.id')
            ->select('a.*','c.*', 'b.jurnal_det_nominal', 'd.*', 'e.kode_perkiraan')            
            ->where('jurnal_no', '=', $search)
            ->where('a.id_kelas', '=', Session::get('kelas'))
            ->where('jurnal_bagian','=',$bagian)
			->where('e.id_lembaga','=',Session::get('idLembaga'))
            //->where('a.kode_transaksi', '=', 'KR')
            ->where('jurnal_tanggal','=',date('Y-m-d'))
            ->get();

        if(count($searchData)>0) {
            return response()->json([
                'status'=>'oke',
                'jbId'=> $searchData[0]->jurnal_bagian_id,
                'jbIdRtgs'=> $searchData[0]->jurnal_rtgs_id,
                'jbNo'=> $searchData[0]->jurnal_rtgs_no,
                'jbTgl'=> $searchData[0]->jurnal_tanggal,                
                'jbPaymentDet'=> $searchData[0]->payment_detail,                
                'jbFromMember'=> $searchData[0]->kode_from_member,
                'jbToMember'=> $searchData[0]->kode_to_member,
                'jbInfoMember'=> $searchData[0]->member_information,
                'jbNominal'=> $searchData[0]->jurnal_det_nominal,
                'jbSendRef'=> $searchData[0]->kode_sender_ref,                
                'jbReceiverRef'=> $searchData[0]->kode_receiver_ref,
                'jbKodeKliring'=> $searchData[0]->kode_kliring,                
                'jbIdKliring'=> $searchData[0]->id_kliring_by_order,                                
                'jbRekLawan'=> $searchData[0]->id_kliring_kode_prefund,                
                'jbKodePerkiraan'=> $searchData[0]->kode_perkiraan,                
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }                
    }

}
