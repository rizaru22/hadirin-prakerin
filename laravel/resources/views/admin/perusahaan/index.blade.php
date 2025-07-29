@extends('layouts.app')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <style>
        .card-header .btn-success{
            background-color: #3D9970;
        }
    </style>
@endsection
@section('namaHalaman','Daftar Perusahaan')
@section('konten')
<div class="card">
    <div class="card-header">
   
    <a href="{{route('perusahaan.create')}}"  class="btn btn-md btn-primary float-right mr-5"> <i class="fas fa-user-plus"></i> Tambah Data</a>
    </div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perusahaan</th>
                        <th>Siswa</th>
                        <th>Peta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->nama_perusahaan }}</td>
                        <td>
                        <ol>
                        @foreach($dt->siswa as $subdt)
                        <li>{{ $subdt->nama_siswa }}</li>
                        @endforeach
                        </ol>
                        </td>
                        <td><a href="https://www.google.com/maps?q={{$dt->latitude.",".$dt->longitude}}" target="_blank"><i class="fas fa-map"></i></a></td>
                        <td>
                            <div class="btn-group">
                                <a type="button" class="btn btn-sm btn-warning btn-flat" href="{{route('perusahaan.edit',$dt->id)}}">
                                    <i class=" fas fa-edit"></i>
                                </a>
                          
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "responsive": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

@if($message = Session::get('success'))
toastr.success("{{ $message}}");
@elseif($message = Session::get('updated'))
toastr.warning("{{ $message}}");
@endif
</script>
@endsection