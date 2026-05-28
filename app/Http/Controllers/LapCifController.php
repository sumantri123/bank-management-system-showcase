<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\NasabahIndividu;
use App\Models\Agama;
use App\Models\Status;
use App\Models\Pendidikanx;
use App\Models\JenisIdentitas;
use App\Models\Penghasilan;
use App\Models\SumberDana;
use App\Models\Pekerjaan;
use App\Models\TRekeningNasabah;
use Auth;
use Session;

class LapCifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {		
        $data = array(
            'title' => 'DAFTAR CUSTOMER NUMBER',
            'subtitle' => Session::get('subtitle'),
            'btnAdd' => 'Tambah',
            'btnClass' => 'btn btn-primary btn-sm px-4',
            'classFormControl' => 'form-control form-control-sm',
            'classFormSelect' => 'form-select form-select-sm',
            'classTable' => 'table table-striped',
            'cif_1' => '00',
            'cif_2' => '',
            'cif_3' => now()->year,
        ); 
        $LAgama = Agama::get();
        $LStatus = Status::get();
        $LPendidikan = Pendidikanx::get();
        $LJenisIdentitas = JenisIdentitas::get();
        $LPenghasilan = Penghasilan::get();
        $LPekerjaan = Pekerjaan::get();
        $LSumberDana = SumberDana::where('status', '=', '1')->get();

        //return view('lap_cif/index', compact('data','LAgama','LStatus','LPendidikan','LJenisIdentitas','LPenghasilan','LSumberDana','LPekerjaan'));        
        $returnHTML = view('lap_cif/index',compact('data','LAgama','LStatus','LPendidikan','LJenisIdentitas','LPenghasilan','LSumberDana','LPekerjaan'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }    
    
}
