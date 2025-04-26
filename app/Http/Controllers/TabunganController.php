<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tabungan;
use App\Models\mutasi;
use App\Models\jenis;

use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index(){
        
        $tabunganall = Tabungan::with(['operator', 'user', 'mutasi.jenisMutasi'])->get();
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
            ->update(['status' => 'inputdata',
                      'operator_id'=>Auth::id()]);
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
    return redirect('/dashboard')->with('success', 'Status berhasil diubah!');
}

public function store(Request $request, $id)    

{
    // Validasi input
    $request->validate([
        'items' => 'required|array',
        'items.*.jenismutasi_id' => 'required|integer',
        'items.*.bobot' => 'required|numeric|min:1',
        'items.*.total_harga' => 'required|numeric|min:0',
    ]);

    // Ambil data tabungan berdasarkan ID
    $tabungan = Tabungan::findOrFail($id); // Gunakan `Tabungan` dengan huruf kapital
    $items = $request->input('items');

    // Proses setiap item dan simpan ke tabel mutasi
    foreach ($items as $item) {
        Mutasi::create([ // Gunakan `Mutasi` dengan huruf kapital
            'tabungan_id' => $tabungan->id, // Gunakan ID tabungan, bukan objek
            'jenismutasi_id' => $item['jenismutasi_id'],
            'bobot' => $item['bobot'],
            'total_harga' => $item['total_harga'],
            'operator_id' => Auth::id(), // Menyimpan ID admin yang sedang login
        ]);
    }

    // Update total bobot dan saldo berdasarkan data mutasi yang sudah ditambahkan
    $totalBobot = $tabungan->mutasi->sum('bobot');
    $totalSaldo = $tabungan->mutasi->sum('total_harga');

    // Update tabungan dengan total bobot dan saldo
    $tabungan->update([
        'total_bobot' => $totalBobot,
        'saldo' => $totalSaldo,
        'status' => 'selesai', // Menandakan status tabungan sudah selesai
    ]);

    // Redirect dengan pesan sukses
    return redirect('/dashboard')->with('success', 'Status berhasil diubah!');
}


}