<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TRekeningAngsuranPinjaman;
use Session;
use Auth;

class LapKartuPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    

    public function index()
    {	        
        $LNasabahIndividu = DB::table('t_rekening_pinjaman as a')
            ->leftJoin('t_rekening_nasabah as b', 'a.id_rekening', '=', 'b.id')
            ->leftJoin('m_nasabah as c', 'b.id_nasabah', '=', 'c.id')
            ->select('b.nomor_rekening', 'a.rekening_pinjaman_id', 'c.nama', 'b.id_pinjaman')                             
            ->where('a.id_kelas','=',Session::get('kelas'))              
			->where('b.id_jenis_rekening','=','4')              
			->whereIn('b.id_pinjaman', [1,2]) 
            ->get();

        $data = array(
            'title' => 'Kartu Pinjaman',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classFormSelect2' => 'single-select',
            'classTable' => 'table table-sm table-bordered table-striped',            
        );         
                
        //return view('lap_kartu_pinjaman/index', compact('data','LNasabahIndividu'));        
        $returnHTML = view('lap_kartu_pinjaman/index',compact('data','LNasabahIndividu'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
        
    }    

    public function getData(Request $request)
    {
        $id = $request->id;               

        $dataTable = DB::select(
            DB::raw('
                SELECT a.*, nomor_rekening, jenis_pinjaman, nominal_pokok, jangka_waktu, provisi_persen,
                bunga_efektif_bulan, bunga_efektif_anuitas
                FROM t_rekening_pinjaman_angsuran as a  
                LEFT JOIN t_rekening_pinjaman as b on a.id_rekening_pinjaman = b.rekening_pinjaman_id
                LEFT JOIN t_rekening_nasabah as c on a.id_rekening = c.id               
                WHERE id_rekening_pinjaman = "'.$id.'"                                
            ')
        );        

        if($dataTable) {
            $provisiPersen = ($dataTable[0]->provisi_persen);
            $nominal = $dataTable[0]->nominal_pokok;
            $jangkaWaktu = $dataTable[0]->jangka_waktu;
            $irr = ($dataTable[0]->bunga_efektif_bulan);
            $sukuBunga = ($dataTable[0]->bunga_efektif_anuitas);
            $jenisPinjaman = (($dataTable[0]->jenis_pinjaman)==1) ? "Installment":"Reguler";

            return response()->json([
                'status'=>'oke',
                'data' => $dataTable,
                'noRek' => $dataTable[0]->nomor_rekening,
                'jenisPinjaman' => $jenisPinjaman,
                'nominalPinjaman' => $nominal,
                'jangkaWaktu' => $jangkaWaktu,
                'provisi' => $provisiPersen,
                'bungaNominal' => $nominal*($sukuBunga/100/12)*$jangkaWaktu,
                'bungaEfektif' => $irr,
                'provisiNominal' => $nominal*($provisiPersen/100),
                'bungaPersen' => $sukuBunga,               
                'total' => count($dataTable),                
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
