<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JenimutasiController extends Controller
{   
    public function index()
{
    $jenis = DB::table('jenismutasi')->get();
    return view ( 'pages.admin.management', compact('jenis'));
}
public function store(Request $request)
{
    $request->merge([
        'harga' => preg_replace('/[^\d]/', '', $request->input('harga')) // Hapus Rp, titik, dll
    ]);

    $request->validate([
        'nama_sampah' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
        'deskripsi' => 'required|string|max:1000',
    ]);

    $file = $request->file('foto');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('file'), $filename);

    DB::table('jenismutasi')->insert([
        'nama_sampah' => $request->input('nama_sampah'),
        'harga' => $request->input('harga'), // Sekarang sudah pasti integer
        'foto' => $filename,
        'deskripsi' => $request->input('deskripsi'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
}
public function update(Request $request)
{
    $data = [
        'nama_sampah' => $request->input('nama_sampah'),
        'harga' => $request->input('harga'),
        'deskripsi' => $request->input('deskripsi'),
        'updated_at' => now(),
    ];
    
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('file'), $filename);
        $data['foto'] = $filename;
    }

    DB::table('jenismutasi')->where('id', $id)->update($data);

    return redirect()->back()->with('success', 'Data berhasil diupdate!');
}
public function destroy(request $request,$id)
{
    $record = DB::table('jenismutasi')->where('id', $id)->first();

    // Hapus file foto dari folder jika ada
    if ($record && file_exists(public_path('file/' . $record->foto))) {
        unlink(public_path('file/' . $record->foto));
    }

    DB::table('jenismutasi')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus!');
}
}
