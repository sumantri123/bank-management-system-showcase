<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\EditPerkiraan;
use App\Models\TRekeningNasabah;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use Auth;
use Session;

class LapMutasiNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {		                    
        
        $data = array(
            'title' => 'Saldo Mutasi Tabungan',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classTable' => 'table table-sm table-bordered table-striped',
            
        );         
        
        //return view('lap_mutasi_nasabah/index', compact('data'));        
        $returnHTML = view('lap_mutasi_nasabah/index',compact('data'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
        
    }            
   

    public function getData(Request $request)
    {
        $date = $request->date;
        $kodeBagian = base64_decode($request->kode);                

        $dataTable = DB::select(                
                
            DB::raw("
                    select nomor_rekening, nama, d.*, l.*, m.jurnal_det_nominal as saldo_awal
                    from t_rekening_nasabah f 
                    left join m_nasabah g on f.id_nasabah = g.id                                       
                    right join (
                        select id_rekening, 
                        sum(case when id_jenis_transaksi = 1 THEN jurnal_det_nominal END) as debit,
                        sum(case when id_jenis_transaksi = 2 THEN jurnal_det_nominal END) as kredit
                        from t_jurnal_bagian_detail b
                        left join t_jurnal_bagian c on b.id_jurnal_bagian = c.jurnal_bagian_id
                        where jurnal_tanggal = '".date('Y-m-d', strtotime($date))."'
                        and id_kelas = ".Session::get('kelas')."
                        and id_perkiraan = ".Session::get('3XXTABUH_ID')."
                        and jurnal_keterangan != 'Data Saldo Awal'
                        group by id_perkiraan, id_rekening
                        order by id_perkiraan
                    ) as d on f.id = d.id_rekening      
                    left join (
                        select id_perkiraan, id_rekening,
                        sum(case when id_jenis_transaksi = 1 THEN jurnal_det_nominal END) as debit_kemarin,
                        sum(case when id_jenis_transaksi = 2 THEN jurnal_det_nominal END) as kredit_kemarin
                        from t_jurnal_bagian_detail j
                        left join t_jurnal_bagian k on j.id_jurnal_bagian = k.jurnal_bagian_id
                        where jurnal_tanggal <= '".date('Y-m-d', strtotime('-1 day',strtotime($date)))."'
                        and id_kelas = ".Session::get('kelas')."
                        and id_perkiraan = ".Session::get('3XXTABUH_ID')."                      
                        group by id_perkiraan, id_rekening
                        order by id_perkiraan
                    ) as l on d.id_rekening = l.id_rekening  
                    left join (
                        select id_perkiraan, id_rekening, jurnal_det_nominal                        
                        from t_jurnal_bagian_detail a
                        left join t_jurnal_bagian e on a.id_jurnal_bagian = e.jurnal_bagian_id
                        where id_kelas = ".Session::get('kelas')."
                        and id_perkiraan = ".Session::get('3XXTABUH_ID')."          
                        and jurnal_keterangan = 'Data Saldo Awal'
                        group by id_perkiraan, id_rekening, jurnal_det_nominal
                        order by id_perkiraan
                    ) as m on d.id_rekening = m.id_rekening                      
                    where f.id_kelas = ".Session::get('kelas')."                  
                    group by nomor_rekening, nama, d.id_rekening, d.debit, d.kredit, l.id_perkiraan,
                    l.id_rekening, l.debit_kemarin, l.kredit_kemarin, m.jurnal_det_nominal
                ")
        );                   

        if($dataTable) {
            return response()->json([
                'status'=>'oke',
                'data' => $dataTable,
                'total' => count($dataTable),                
                'date' => $date
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
}
