<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\tabungan;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexe(){

// Ambil tabungan dengan status proses, pengambilan, sampai
$tabungproses = DB::table('tabungan')
->join('users', 'tabungan.user_id', '=', 'users.id')
->whereIn('tabungan.status', ['proses','pengambilan','sampai'])
->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
->get();

// Ambil tabungan dengan status sampai, inputdata
$tabunginput = DB::table('tabungan')
->join('users', 'tabungan.user_id', '=', 'users.id')
->whereIn('tabungan.status', ['sampai','inputdata'])
->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
->get();

$tabungjadi = DB::table('tabungan')
->join('users', 'tabungan.user_id', '=', 'users.id')
->whereIn('tabungan.status', ['selesai'])
->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
->get();

// Ambil semua data jenis mutasi (buat select option di form)
$jenismutasi = DB::table('jenismutasi')->select('id', 'nama_sampah', 'harga')->get();
$user = Auth::user();
$tabungan = tabungan::where('user_id',$user->id)->get();
$saldo = tabungan::where('user_id',$user->id)->sum('saldo');
$totalBobot = Tabungan::where('user_id', $user->id)->sum('total_bobot');


return view('pages.nasabah.dashuser', [
'tabungproses' => $tabungproses,
'saldo'=>$saldo,
'tabungan'=>$tabungan,
'totalbobot'=>$totalBobot,
'tabungjadi'=>$tabungjadi,
'tabunginput' => $tabunginput,
'jenismutasi' => $jenismutasi,
]);    
}    
}
