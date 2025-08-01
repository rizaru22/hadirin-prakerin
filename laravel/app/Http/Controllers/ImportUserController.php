<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Each;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;



class ImportUserController extends Controller
{
    public $data=array();
    //
    public function index():View
    {
        return view('admin.siswa.upload',[
            "title"=>"Siswa",
        ]);
    }

    public function import(Request $request):RedirectResponse
    {
        $valid=$request->validate([
            "file"=>[
                "required",
                File::types(['xlsx','xls','csv'])
                ]
        ]);
        if ($valid){

            $valid['file'] = $request->file('file')->store('upload');

            $lokasi=Storage::disk('public')->path($valid['file']);
          
            $rows=SimpleExcelReader::create($lokasi)->getRows();
            $rows->each(function(array $rowProperties){
                $this->data[]=$rowProperties;
            });
            
            foreach ($this->data as $dt){
                $user=new User;
                $user->name=$dt['nama'];
                $user->username=strstr($dt['email'],'@',true);
                $user->email=$dt['email'];
                $user->password=Hash::make('1234');
                $user->role='user';
                $user->save();

                $siswa=new \App\Models\Siswa;
                $siswa->user_id=$user->id;
                $siswa->nama_siswa=$dt['nama'];
                $siswa->perusahaan_id='1';
                $siswa->kelas=$dt['kelas'];
                $siswa->save();
            }
        }
        return redirect()->route('siswa.index')->with('success','Berhasil Import Data Siswa');
    }
}
