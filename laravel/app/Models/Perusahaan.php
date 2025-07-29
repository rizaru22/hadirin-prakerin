<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    //
    protected $fillable = [
        'nama_perusahaan',
        'latitude',
        'longitude'
    ];

    public function Siswa(){
        return $this->hasMany(Siswa::class);
    }
}
