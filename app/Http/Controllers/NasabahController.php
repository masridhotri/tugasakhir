<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\mutasi;
use App\Models\tabungan;
use App\Models\Saldo;


class NasabahController extends Controller
{
    public function indexuser(){

        $orang = Auth::user();
        $tabungan = tabungan::where('user_id',$orang->id)->get();
        
        return view('pages.nasabah.riwayatsetor',compact('tabungan'));
    }

    public function saldouser(){

        $uangkeluar = Saldo::where('user_id', auth()->id())
        ->sum('uangkeluar');
        $saldo = Tabungan::where('user_id', Auth::id())->sum('saldo');
        $uangmasuk = Mutasi::whereHas('tabungan', function ($query) {
            $query->where('user_id', Auth::id());
        })->sum('total_harga');
                return view('pages.admin.mutasisaldouser',compact('uangkeluar','saldo','uangmasuk'));
    }

    public function tarik(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer|min:1',
        ]);
    
        // Ambil tabungan milik user yang login
        $tabungan = tabungan::where('user_id', Auth::id())->first();
        // Cek saldo cukup atau tidak
        // $nominal = (int) $request->nominal;
        // $saldo = (int) $tabungan->saldo;
        
        // if ($saldo < $nominal) {
        //     return back()->withErrors(['nominal' => 'Saldo tidak mencukupi untuk pengeluaran.']);
        // }
        

        // Kurangi saldo tabungan user
        $tabungan->saldo -= $request->nominal;
        $tabungan->save();
    
        // Catat pengeluaran ke tabel saldo
        Saldo::create([
            'user_id' => Auth::id(), // langsung dari user yang login
            'uangkeluar' => $request->nominal,
        ]);
    
        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat dan saldo dikurangi.');
    }
    
    
}
