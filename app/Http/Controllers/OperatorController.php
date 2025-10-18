<?php

namespace App\Http\Controllers;

use App\Models\tabungan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class OperatorController extends Controller
{
    public function operator()
    {
        $role = auth()->user()->role;

        if ($role === 'operator') {
         $user = Auth::user();
          $tabungproses = tabungan::where('status', 'proses')
                ->count();
          $tabunganall = DB::table('tabungan')->get();
          $tabungambil = DB::table('tabungan')
                        ->where('status', 'pengambilan')
                        ->get();
        $dataBobot = DB::table('tabungan')
                 ->where('operator_id', auth()->id())
                 ->whereDate('created_at', Carbon::today())
                 ->count('total_bobot');
        $tabungpro = DB::table('tabungan')
                ->join('users', 'tabungan.user_id', '=', 'users.id')
                ->whereIn('tabungan.status', ['proses', 'inputdata'])
                ->select('tabungan.*', 'users.name as nama_user', 'users.alamat as alamat_user')
                ->get();
                $lokasi = DB::table('tabungan')
    ->join('users', 'tabungan.user_id', '=', 'users.id')
    ->whereNotNull('users.garis_lintang')
    ->whereNotNull('users.garis_bujur')
    ->select(
        'users.name',
        'users.garis_lintang',
        'users.garis_bujur'
    )
    ->get();

            return view('pages.operator.dash', compact('tabungproses','dataBobot','tabunganall','tabungambil','tabungpro','lokasi'));
        }
    }

    public function enam()
    {
        $tabungan = Tabungan::where('operator_id', Auth::id())->get();

        return view('pages.operator.riwayat', compact('tabungan'));

    }
}
