<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\NasabahIndividu;
use App\Models\EditPerkiraan;
use App\Models\SandiPemilik;
use App\Models\TRekeningNasabah;
use Auth;
use Session;

class NasabahTabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {		
        $LNasabahIndividu = DB::table('m_nasabah')            
            ->select('*')                        
            ->where('id_kelas','=',Session::get('kelas'))
            /* ->orWhere('id_kelas', '=', null)             */
            ->get(); 
        $LEditPerkiraan = EditPerkiraan::where('kode_perkiraan','=',Session::get('3XXTABUH'))
						->where('id_lembaga','=',Session::get('idLembaga'))
						->get();
        $LSandiPemilik = SandiPemilik::get();

        $data = array(
            'title' => 'Entry Rekening Tabungan Nasabah',
            'subtitle' => Session::get('subtitle'),
            'pass' => Session::get('passAdmin'),
            'btnAdd' => 'Tambah',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classTable' => 'table table-sm table-striped',
            'kode_perkiraan' => $LEditPerkiraan->isEmpty() ? '' : $LEditPerkiraan[0]['kode_perkiraan'],
            'id_perkiraan' => $LEditPerkiraan->isEmpty() ? '' : $LEditPerkiraan[0]['id'],
        );         
        
        //return view('nasabah_tabungan/index', compact('data','LNasabahIndividu','LSandiPemilik'));        
        $returnHTML = view('nasabah_tabungan/index',compact('data','LNasabahIndividu','LSandiPemilik'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
        
    }

    public function getData()
    {
        //$nasabahIndividu = NasabahIndividu::where('status_nasabah','=',2)->get();
        $nasabahIndividu = DB::table('t_rekening_nasabah as a')
            ->leftJoin('m_nasabah', 'a.id_nasabah', '=', 'm_nasabah.id')            
            ->select('a.id as tab_id', 'a.bunga', 'a.tanggal_buka', 'a.nomor_rekening', 'a.id_nasabah', 'a.sandi_pemilik', 'm_nasabah.*')            
            ->where('id_jenis_rekening','=',2)
            ->where('a.id_kelas','=',Session::get('kelas'))
            ->orderBy('a.id', 'desc')
            ->get();
        if($nasabahIndividu) {
            return response()->json([
                'status'=>'oke',
                'data' => $nasabahIndividu
                ]);
        } else {
            return response()->json(['status'=>'failed']);
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

            $orderObj = DB::table('t_rekening_nasabah')->select('nomor_rekening')->where('id_perkiraan','=',Session::get('3XXTABUH_ID'))->where('id_kelas','=',Session::get('kelas'))->latest('id')->first();        
            if ($orderObj) {
                $lastKodeNumber = explode('.',$orderObj->nomor_rekening);
                $lastKodeNumber2 = $lastKodeNumber[1];
                //$removed1char = substr($lastKodeNumber2, 1);

                //if($lastKodeNumber[2]!=date('Y')){
                    //$KodeNumber2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
                //} else {
                    $KodeNumber2 = str_pad($lastKodeNumber2 + 1, 4, "0", STR_PAD_LEFT);
                //}
                
            } else {
                $KodeNumber2 = str_pad(1, 4, "0", STR_PAD_LEFT);                 
            }

            //var_dump($request->post());
            $kodePerkiraan = Session::get('3XXTABUH');
            $nomorRekening = $kodePerkiraan.'.'.$KodeNumber2;
            $jenisRekening = 2;

            DB::beginTransaction();
            try {
                $insert = TRekeningNasabah::create([
                    "nomor_rekening"=> $nomorRekening,
                    "id_perkiraan"=> $request->id_perkiraan,				
                    "id_jenis_rekening"=> $jenisRekening,
                    "id_nasabah"=> $request->customer_number,
                    "tanggal_buka"=> date('Y-m-d', strtotime($request->tgl)), 
                    "sandi_pemilik"=> $request->sandi_pemilik,
                    "bunga"=> $request->bunga,                               
                    "id_kelas"=> Session::get('kelas'),
                    "user_record"=> Session::get('login_as'),                              
                    "dt_record"=> date("Y-m-d H:i:s")   
                ]);

                if($insert) {
                    DB::commit(); 
                    return response()->json(['status'=>'insert_successful','msg'=>' Rekening Anda '.$nomorRekening]);                    
                } else {
                    return response()->json(['status'=>'insert_failed']);
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


    public function update(Request $request, $id)
    {
        if($request->ajax()){
            // if ($this->validateRequest($request, $id)->fails()) {

            //     return response()->json([
            //         'status'=>'insert_failed',
            //         'error' => $this->validateRequest($request, $id)->messages()
            //         ]);
            // }            
            
            $update = TRekeningNasabah::where('id', '=', $id)->update([              
                "bunga"=> $request->bunga,
                "id_kelas"=> Session::get('kelas'),
                "dt_modified"=> date("Y-m-d H:i:s"),
				"user_modified"=> Session::get('login_as')
            ]);

            if($update) {
                return response()->json(['status'=>'insert_successful']);
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
            $query = TRekeningNasabah::find($id)->delete();
            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return response()->json(['status'=>'delete_failed']);
        }
    }

    
}
