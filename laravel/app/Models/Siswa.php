<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = [
        'nama_siswa',
        'user_id',
        'perusahaan_id',
        'kelas',
    ];

    public function Perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
