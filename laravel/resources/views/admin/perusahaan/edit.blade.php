@extends('layouts.app')

@section('style')
    <style>
        .card-footer .btn-success{
            background-color: #3D9970;
        }
        .card-header{
            background-color: #3D9970 !important;
        }
    </style>
@endsection
@section('namaHalaman','Tambah Data Pegawai')
@section('konten')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada masalah dengan data yang disimpan.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Perusahaan</h3>
    </div>
    <div class="card-body">

        <form action="{{route('perusahaan.update',$perusahaan->id)}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="nama">Nama Perusahaan:</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" value="{{$perusahaan->nama_perusahaan}}" required>
            </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="latitude">Latitude :</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{$perusahaan->latitude}}">
                    </div>
                    <div class="col-6">
                        <label for="logitude">Longitude:</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{$perusahaan->longitude}}">
                    </div>

                </div>
            </div>
          
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection