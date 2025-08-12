<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Libur;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Pengaturan;
use Hamcrest\Type\IsBoolean;
use Illuminate\Support\Facades\Http;

class SendNotificationController extends Controller
{
    //
    public function notifikasiMasuk()
    {
        $no = 1;
        $nama2 = '';
        $tanggal = Carbon::now();
        $user = Siswa::select('user_id', 'nama_siswa','kelas','nama_perusahaan')
            ->join('perusahaans', 'perusahaans.id', '=', 'siswas.perusahaan_id')
            ->orderBy('kelas', 'asc')
            ->orderBy('nama_siswa', 'asc')
            ->get()->toArray();
        foreach ($user as $us) {
            $nama = '';
            $absensi = Absensi::select('jam_masuk')->where('user_id', $us['user_id'])->whereDate('tanggal', $tanggal)->get();
            if (blank($absensi)||$absensi[0]->jam_masuk == '0') {
                $nama = "\r\n" . $no.'.'.$us['nama_siswa'].'-'.$us['kelas'].'-'.$us['nama_perusahaan'];
                $no++;
            }
            
            $nama2 .= $nama;
            
        }
        
        if ($this->cek_hari_libur()==false){
            $this->apiPesan("Belum Absen Masuk " . $tanggal->isoFormat('DD MMMM Y') . ': ' . $nama2);
        }
    }
    
    public function notifikasiPulang()
    {
        $no = 1;
        $nama2 = '';
        $tanggal = Carbon::now();
        
       $user = Siswa::select('user_id', 'nama_siswa','kelas','nama_perusahaan')
            ->join('perusahaans', 'perusahaans.id', '=', 'siswas.perusahaan_id')
            ->orderBy('kelas', 'asc')
            ->orderBy('nama_siswa', 'asc')
            ->get()->toArray();
        foreach ($user as $us) {
            $nama = '';
            $absensi = Absensi::select('jam_pulang')
            ->where('user_id', $us['user_id'])->whereDate('tanggal', $tanggal)->get()->toArray();
            // dd($absensi[0]->jam_pulang,$us['name'],$tanggal);
            if (blank($absensi)) {
                $nama = "\r\n" . $no.'.'.$us['nama_siswa'].'-'.$us['kelas'].'-'.$us['nama_perusahaan'];
                $no++;
            } elseif ($absensi[0]['jam_pulang'] == '0') {
                $nama = "\r\n" . $no.'.'.$us['nama_siswa'].'-'.$us['kelas'].'-'.$us['nama_perusahaan'];
                $no++;
            }

            $nama2 .= $nama;
            
        }

        
        if ($this->cek_hari_libur()==false){
            $this->apiPesan("Belum Absen Pulang " . $tanggal->isoFormat('DD MMMM Y') . ': ' . $nama2);
        }

    }

    public function apiPesan($pesan)
    {
        // Http::post('https://api.telegram.org/bot7241376794:AAHTp6dr5SywEgFVktN5LB3UPm2apn7hmqQ/sendMessage?', [
        //     'chat_id' => '-1002344798403',
        //     'text' => $pesan
        // ]);

        $group_wa_id = Pengaturan::get()->first()->group_wa_id;
        $token=Pengaturan::get()->first()->token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $group_wa_id, //group id
                'message' => $pesan, //message
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization:'.$token //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function cek_hari_libur()
    {
        $hari_libur=Libur::whereDate('tanggal',Carbon::today())->get();
        // dd($hari_libur);
        if(!blank($hari_libur)){
            return true;
        }else
        {
            return false;
        }
    }
}
