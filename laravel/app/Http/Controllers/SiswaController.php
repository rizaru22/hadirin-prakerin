<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    //

    public function index(){
        return view('admin.siswa.index',[
            "title"=>"Siswa",
            "siswa" => \App\Models\Siswa::all(),
        ]);
    }

    public function create(){
        return view('admin.siswa.create',[
            "title"=>"Siswa",
            "perusahaan" => \App\Models\Perusahaan::all(),
        ]);
    }

    public function store(Request $request){
        //get data from request
        $request->validate([
            "nama_siswa"=>"required",
            "kelas"=>"required",
            "email"=>"required",
            "perusahaan_id"=>"required",
        ],[
            "nama_siswa.required"=>"Nama siswa harus diisi",
            "kelas.required"=>"Kelas harus diisi",
            "email.required"=>"Email harus diisi",
            "perusahaan_id.required"=>"Perusahaan harus diisi",
        ]);

        

        //setting data for table user
        $username=strstr($request->email,'@',true);
        $password=Hash::make('1234');
        $role='user';

        //store to the table user
        $user=new \App\Models\User;
        $user->name=$request->nama_siswa;
        $user->username=$username;
        $user->password=$password;
        $user->email=$request->email;
        $user->role=$role;
        $user->save();

        //store to the table siswa
        $siswa=new \App\Models\Siswa;
        $siswa->user_id=$user->id;
        $siswa->nama_siswa=$request->nama_siswa;
        $siswa->kelas=$request->kelas;
        $siswa->perusahaan_id=$request->perusahaan_id;
        $siswa->save();


        return redirect()->route('siswa.index')->with('success', 'Berhasil tambah data siswa '.$user->name);
    }

    public function edit($id){
        return view('admin.siswa.edit',[
            "title"=>"Siswa",
            "siswa" => \App\Models\Siswa::findOrFail($id),
            "perusahaan" => \App\Models\Perusahaan::all(),
        ]);
    }

    public function update(Request $request,$id){
        $siswa=\App\Models\Siswa::findOrFail($id);
        $siswa->nama_siswa=$request->nama_siswa;
        $siswa->kelas=$request->kelas;
        $siswa->perusahaan_id=$request->perusahaan_id;
        $siswa->save();
        
        return redirect()->route('siswa.index')->with('success', 'Berhasil ubah data '.$siswa->nama_siswa);
    }
}
