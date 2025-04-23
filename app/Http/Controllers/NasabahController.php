<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\mutasi;
use App\Models\tabungan;

class NasabahController extends Controller
{
    public function indexuser(){

        $orang = Auth::user();
        $tabungan = tabungan::where('user_id',$orang->id)->get();
        
        return view('pages.nasabah.riwayatsetor',compact('tabungan'));
    }

    public function saldouser(){
        return view('pages.admin.mutasisaldouser');
    }

    public function tarik(Request $request, $id)
    {
         $request->validate([
        'nominal' => 'required|integer|min:1',
    ]);

    $mutasi = Mutasi::findOrFail($id);
    $tabungan = Tabungan::where('id', $mutasi->tabungan_id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

    // Cek apakah saldo cukup untuk penambahan nominal baru
    if ($tabungan->saldo < $request->nominal) {
        return back()->withErrors(['nominal' => 'Saldo tidak mencukupi untuk penambahan nominal.']);
    }

    // Tambahkan nominal baru ke nominal yang sudah ada (jika ada)
    $mutasi->nominal = ($mutasi->nominal ?? 0) + $request->nominal; // Update nominal dengan penambahan
    $mutasi->save();

    // Kurangi saldo tabungan
    $tabungan->saldo -= $request->nominal;
    $tabungan->save();

    return redirect()->back()->with('success', 'Nominal berhasil ditambahkan dan saldo dikurangi.');
    }
}
