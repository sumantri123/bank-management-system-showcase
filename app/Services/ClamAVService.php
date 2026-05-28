<?php 
namespace App\Services;
use Illuminate\Support\Facades\Log;

class ClamAVService
{
    public function scan($filePath)
    {
        // Jalankan perintah clamscan
        $output = shell_exec("clamscan --bell -f --no-summary " . escapeshellarg($filePath));
        
        // Log hasil pemindaian
        Log::info("ClamAV Scan Result: " . $output);
        
        // Periksa apakah file terinfeksi
        if (strpos($output, 'Infected files: 0') === false) {
            return false; // File terinfeksi
        }
        return true; // File bersih
    }
}