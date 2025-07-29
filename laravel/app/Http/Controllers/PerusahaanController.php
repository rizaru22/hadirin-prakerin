<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    //

    public function index()
    {
        return view('admin.perusahaan.index', [
            "title" => "Perusahaan",
            "data" => \App\Models\Perusahaan::all()
        ]);
    }

    public function create()
    {
        return view('admin.perusahaan.create', [
            "title" => "Tambah Perusahaan"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_perusahaan" => "required",
            "latitude" => "required",
            "longitude" => "required"
        ]);

        \App\Models\Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $perusahaan = \App\Models\Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit', [
            "title" => "Edit Perusahaan",
            "perusahaan" => $perusahaan
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "nama_perusahaan" => "required",
            "latitude" => "required",
            "longitude" => "required"
        ]);

        $perusahaan = \App\Models\Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diupdate');
    }
}
