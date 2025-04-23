<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tabungan;
use App\Models\mutasi;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index(){
        $tabunganall = tabungan::with('mutasi')->get();
        return view('pages.nasabah.mutasiuser',compact('tabunganall'));
    }
    public function new()
{
    DB::table('tabungan')->insert([
        'user_id' => Auth::id(),
        'status' => 'proses',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Transaksi baru berhasil dibuat.');
}
public function update(request $request,$id){
    $tabung = DB::table('tabungan')->where('id',$id)->first();

    if ($tabung && $tabung->status === 'proses') {
        DB::table('tabungan')
            ->where('id', $id)
            ->update(['status' => 'pengambilan']);
    }
    return redirect()->back()->with('success', 'Status berhasil diubah!');
}
public function sampai(request $request,$id){
    $tabung = DB::table('tabungan')->where('id',$id)->first();

    if ($tabung && $tabung->status === 'pengambilan') {
        DB::table('tabungan')
            ->where('id', $id)
            ->update(['status' => 'sampai']);
    }
    return redirect()->back()->with('success', 'Status berhasil diubah!');
}
public function input(request $request,$id){
    $tabung = DB::table('tabungan')->where('id',$id)->first();

    if ($tabung && $tabung->status === 'sampai') {
        DB::table('tabungan')
            ->where('id', $id)
            ->update(['status' => 'inputdata']);
    }
    return redirect()->back()->with('success', 'Status berhasil diubah!');
}
public function store(Request $request, $id)
{
    // Validasi input

    // $request->validate([
    //     'tabungan_id' => 'required|exists:tabungan,id',
    //     'jenismutasi_id' => 'required|integer|exists:jenismutasi,id',
    //     'bobot' => 'required|numeric|min:0',
    //     'total_harga' => 'required|numeric|min:0',
    // ]);

    DB::beginTransaction();

    try {
        // Ambil semua data JSON
        $data = $request->all(); // Laravel otomatis decode JSON jika header Content-Type: application/json

        $items = $data['items'] ?? [];

        if (empty($items)) {
            return response()->json(['message' => 'Data item kosong'], 400);
        }

        $tabungan = tabungan::findOrFail($id);

        foreach ($items as $item) {
            // Validasi item satu-satu (bisa ditambah if butuh strict)
            $jenismutasi_id = $item['jenismutasi_id'] ?? null;
            $bobot = $item['bobot'] ?? 0;
            $total_harga = $item['total_harga'] ?? 0;

            if (!$jenismutasi_id || $bobot <= 0 || $total_harga <= 0) {
                continue; // lewati kalau ada item aneh
            }

            mutasi::create([
                'tabungan_id' => $id,
                'jenismutasi_id' => $jenismutasi_id,
                'bobot' => $bobot,
                'total_harga' => $total_harga,
                'admin_id' => auth()->id(),
            ]);
        }

        // Update tabungan
        $tabungan->update([
            'total_bobot' => $tabungan->mutasi->sum('bobot'),
            'saldo' => $tabungan->mutasi->sum('total_harga'),
            'status' => 'selesai',
        ]);

        DB::commit();

        return response()->json(['message' => 'Data berhasil ditambahkan dan status diset jadi selesai!']);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

}