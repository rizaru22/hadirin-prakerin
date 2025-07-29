@extends('layouts.app')

@section('style')
    <style>
        .card-footer .btn-success {
            background-color: #3D9970;
        }

        .card-header {
            background-color: #3D9970 !important;
        }
    </style>
@endsection
@section('namaHalaman', 'Tambah Data Pegawai')
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
            <h3 class="card-title">Tambah Data Pegawai</h3>
        </div>
        <div class="card-body">

            <form action="{{ route('siswa.update', $siswa->id) }}') }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nama_siswa">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap"
                        required value="{{ $siswa->nama_siswa }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        disabled required value="{{ $siswa->user->email }}">
                </div>
                <div class="form-group">
                    <label for="perusahaan">Perusahaan:</label>
                    <select class="form-control" id="perusahaan_id" name="perusahaan_id">
                        <option value="">Pilih Perusahaan</option>
                        @foreach ($perusahaan as $p)
                            <option value="{{ $p->id }}" {{ $p->id == $siswa->perusahaan_id ? 'selected' : '' }}>{{ $p->nama_perusahaan }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas:</label>
                    <select class="form-control" id="kelas" name="kelas">
                        <option value="">Pilih Kelas</option>
                        <option value="XII RPL 1" {{ $siswa->kelas == 'XII RPL 1' ? 'selected' : '' }}>XII RPL 1</option>
                        <option value="XII RPL 2" {{ $siswa->kelas == 'XII RPL 2' ? 'selected' : '' }}>XII RPL 2</option>
                    </select>
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
