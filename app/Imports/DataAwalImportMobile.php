<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\NilaiTukar;
use App\Models\NasabahIndividu;
use App\Models\TRekeningNasabah;
use App\Models\JurnalBagian;
use App\Models\JurnalBagianDetail;
use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use DB;
use Session;
use Auth;
use Hash;

class DataAwalImportMobile implements  ToCollection, WithHeadingRow
{
    private $nama_file; 
    private $path; 

    
    public function __construct($nama_file,$path)
    {
        $this->nama_file = $nama_file; 
        $this->path = $path; 
    }
    
    public function collection(Collection  $rows)
    {   

        $kolom_format = array(                   
            'kode_nasabah',
            'status_nasabah',
            'sa_giro_temp',
            'sa_tab_temp',
            'sa_dep_temp',
            'sa_pin_temp',
            'sa_pinkre_temp',
            'sa_pin_temp_2',
            'jangka_waktu_temp',
            'irr_temp',
            'suku_bunga',
            'provisi',
            'nama',
            'kewarganegaraan',
            'kota_ktp',
			'username',
			'password_mbanking',
			'pin_mbanking',
			'nama_panggilan',
        );
        
        $kolom_excel = $rows[0]->toArray();
        $error = false;
        foreach($kolom_format as $kolom){
            if(array_key_exists($kolom,$kolom_excel)){
                
            } else {
                $error = true;
            }
        } 

        if($error) {                    
            $this->hasil = ["status"=>404,"message"=>"Format FIle Excel Tidak Sesuai Template"];
            
        }else {     
            
            DB::beginTransaction();
            try {

                // Insert File
                $insertDataFile = File::create([
                    "file_name"=> $this->nama_file,
                    "file_path"=> $this->path,                        
                    "id_kelas"=> Session::get('kelas'),                        
                    "user_record"=> Auth::user()->name,   
                    "dt_record"=> date("Y-m-d H:i:s"),
                ]);

                // Insert Nilai Tukar (TT, BN, TC)
                $LNilaiTukar = NilaiTukar::where('id_kelas','=',Session::get('kelas'))->get();
                if(count($LNilaiTukar)==0) {
                   
                    $kursNama = array("Kurs TT","Kurs BN","Kurs TC");
                    $kursBeli = array(9400,10400,8400);
                    $kursJual = array(9500,10500,8500);

                    for($a=0; $a<3; $a++){
                        $insertNilaiTukar = NilaiTukar::create([
                            "kurs_nama"=> $kursNama[$a],
                            "kurs_beli"=> $kursBeli[$a],
                            "kurs_jual"=> $kursJual[$a],                       
                            "id_kelas"=> Session::get('kelas'),                       
                            "created_at"=> date("Y-m-d H:i:s")
                        ]);
                    }                    
                }

                foreach ($rows as $row) {

                    $cekData = NasabahIndividu::where([
                        ['nama','=',$row['nama']],                                    
                        ['id_kelas','=',Session::get('kelas')],
                    ])->count();
                    
                    if($cekData==0){
                        // Insert Data Cif
                        $orderObj = DB::table('m_nasabah')->select('cif')->latest('id')->first();        
                        if ($orderObj) {
                            $lastKodeCif = explode('.',$orderObj->cif);
                            $lastCif2 = $lastKodeCif[1];
                            //$removed1char = substr($lastCif2, 1);
            
                            if($lastKodeCif[2]!=date('Y')){
                                $cif_2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
                            } else {
                                $cif_2 = str_pad($lastCif2 + 1, 5, "0", STR_PAD_LEFT);
                            }
                            
                        } else {
                            $cif_2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
                        }
            
                        $cifAll = $row['kode_nasabah'].'.'.$cif_2.'.'.date('Y');
                        
                        //echo $row['jangka_waktu_temp'].'-'.$row['irr_temp'].'-'.$row['suku_bunga'].'-'.$row['provisi'].'-'.$row['status_nasabah'].'-'.$row['kota_ktp'];
                        $insertDataCif = NasabahIndividu::create([
                            "cif"=> $cifAll,
                            "sa_giro_temp"=> $row['sa_giro_temp'],
                            "sa_tab_temp"=> $row['sa_tab_temp'],
                            "sa_dep_temp"=> $row['sa_dep_temp'],
                            "sa_pin_temp"=> $row['sa_pin_temp'],
                            "sa_pinkre_temp"=> $row['sa_pinkre_temp'],
                            "sa_pin_temp_2"=> $row['sa_pin_temp_2'],
                            "jangka_waktu_temp"=> $row['jangka_waktu_temp'],
                            "irr_temp"=> $row['irr_temp'],
                            "suku_bunga"=> $row['suku_bunga'],
                            "provisi"=> $row['provisi'],
                            "nama"=> $row['nama'],
                            "status_nasabah"=> $row['status_nasabah'],
                            "kewarganegaraan"=> $row['kewarganegaraan'],
                            "kota_ktp"=> $row['kota_ktp'],                        
                            "id_kelas"=> Session::get('kelas'),                       
                            "id_file"=> $insertDataFile->file_id,                       
                            "dt_record"=> date("Y-m-d H:i:s"),
                            "created_at"=> Auth::user()->name,   
							"username"=> $row['username'],
							"password_mbanking"=> Hash::make($row['password_mbanking']),
							"pin_mbanking"=> $row['pin_mbanking'],
							"nama_panggilan"=> $row['nama_panggilan'],
                        ]);                        
                    } else {
                        $this->hasil = ["500"=>200,"msg"=>"Data Nasabah Sudah Pernah Diupload"];
                        //return response()->json(['status'=>'insert_failed2','msg'=>'Data Nasabah Sudah Pernah Diupload']);
                    }
                }
				
				// insert untuk rekening merchant digunakan untuk mobile banking				
				$cekDataMerchant = TRekeningNasabah::where([
					['merchant','=','y'],                                    
					['id_kelas','=',Session::get('kelas')],
				])->count();
				
				if($cekDataMerchant == 0){
					
					// 1. CREATE CIF
					$orderObj = DB::table('m_nasabah')->select('cif')->latest('id')->first();        
					if ($orderObj) {
						$lastKodeCif = explode('.',$orderObj->cif);
						$lastCif2 = $lastKodeCif[1];
						//$removed1char = substr($lastCif2, 1);
		
						if($lastKodeCif[2]!=date('Y')){
							$cif_2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
						} else {
							$cif_2 = str_pad($lastCif2 + 1, 5, "0", STR_PAD_LEFT);
						}
						
					} else {
						$cif_2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
					}
					$cifAll = '01.'.$cif_2.'.'.date('Y');
					$insertDataCif = NasabahIndividu::create([
						"cif"=> $cifAll,
						"sa_giro_temp"=> 50000000,
						"sa_tab_temp"=> 10000000,
						"sa_dep_temp"=> 10000000,
						"sa_pin_temp"=> 50000000,
						"sa_pinkre_temp"=> 5000000,
						"sa_pin_temp_2"=> 100000000,
						"jangka_waktu_temp"=> 36,
						"irr_temp"=> '2.358',
						"suku_bunga"=> 15,
						"provisi"=> 3,
						"nama"=> 'PT. MERCHANT',
						"status_nasabah"=> 2,
						"kewarganegaraan"=> 'INDONESIA',
						"kota_ktp"=> 'SURABAYA',                        
						"id_kelas"=> Session::get('kelas'),                       						                     
						"dt_record"=> date("Y-m-d H:i:s"),
						"created_at"=> Auth::user()->name,   
					]); 	

					// 2. CREATE REKENING TABUNGAN MERCHANT
					$cekDataMerchant = TRekeningNasabah::where([
						['merchant','=','y'],                                    
						['id_kelas','=',Session::get('kelas')],
					])->count();	
					
					if($cekDataMerchant == 0){
						
						$orderObj0 = DB::table('t_rekening_nasabah')->select('nomor_rekening')->where('id_perkiraan','=',Session::get('3XXTABUH_ID'))->where('id_kelas','=',Session::get('kelas'))->latest('id')->first();        
						if ($orderObj0) {
							$lastKodeNumber = explode('.',$orderObj0->nomor_rekening);
							$lastKodeNumber2 = $lastKodeNumber[1];
							$KodeNumber2 = str_pad($lastKodeNumber2 + 1, 4, "0", STR_PAD_LEFT);
							
						} else {
							$KodeNumber2 = str_pad(1, 4, "0", STR_PAD_LEFT);                 
						}
						
						$kodePerkiraan = Session::get('3XXTABUH');
						$nomorRekening = $kodePerkiraan.'.'.$KodeNumber2;
						$jenisRekening = 2;
						$merchant = 'y';
						
						// 1. CREATE REKENING TABUNGAN MERCHANT
						$insertRektaMerchant = TRekeningNasabah::create([
							"nomor_rekening"=> $nomorRekening,
							"id_perkiraan"=> Session::get('3XXTABUH_ID'),				
							"id_jenis_rekening"=> $jenisRekening,
							"id_nasabah"=> $insertDataCif->id,
							"tanggal_buka"=> date('Y-m-d'), 
							"id_kelas"=> Session::get('kelas'),
							"user_record"=> Session::get('login_as'),                              
							"dt_record"=> date("Y-m-d H:i:s"),
							"merchant"=> $merchant   
						]);

						// Insert Jurnal Bagian
						$orderJB = DB::table('t_jurnal_bagian')->select('jurnal_no')->where('jurnal_keterangan','=','Data Saldo Awal')->latest('jurnal_bagian_id')->first();        
						if ($orderJB) {
							$lastKodeNumber = explode('.',$orderJB->jurnal_no);
							$lastKodeNumber2 = $lastKodeNumber[1];
							$KodeNumber2 = str_pad($lastKodeNumber2 + 1, 5, "0", STR_PAD_LEFT);
							
						} else {
							$KodeNumber2 = str_pad(1, 5, "0", STR_PAD_LEFT);                 
						}
						
						$bagian = "CS";
						$jurnalNo = $bagian.'.'.$KodeNumber2.'.'.date('d-m-y');

						$insertJBMerchant = JurnalBagian::create([
							"jurnal_no"=> $jurnalNo,
							"jurnal_keterangan"=> "Data Saldo Awal",
							"jurnal_tanggal"=> date('Y-m-d'),
							"jurnal_bagian"=> $bagian,                    
							"id_kelas"=> Session::get('kelas'),                        
							"dt_record"=> date("Y-m-d H:i:s"),
							"user_record"=> Session::get('login_as')           
						]);
						

						// Insert Jurnal Bagian Detail
						$insertJBDetMerchant = JurnalBagianDetail::create([
							"id_perkiraan"=> Session::get('3XXTABUH_ID'),
							"id_jurnal_bagian"=> $insertJBMerchant->jurnal_bagian_id,
							"id_jenis_transaksi"=> 2,
							"jurnal_det_nominal"=> 10000000,
							"id_rekening"=> $insertRektaMerchant->id,
							"id_kode_transaksi"=> 7,
							"dt_record"=> date("Y-m-d H:i:s"),
							"user_record"=> Session::get('login_as'),   
						]);   
					}
				}
				
                DB::commit();
                $this->hasil = ["status"=>200,"msg"=>"Data Berhasil Masuk"];    

            } catch (\Throwable $e) {                
                DB::rollback();
                throw $e;                                     
                $this->hasil = ["500"=>200,"msg"=>"Terjadi Kesalahan Pada Sistem"];

            }                
        }
    }
      
    public function getHasil()
    {
        return $this->hasil;
    }
}
