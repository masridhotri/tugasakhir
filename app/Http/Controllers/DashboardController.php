<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\tabungan;
use App\Models\mutasi;
use App\Models\user;



use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexe(){
        $role = auth()->user()->role;

    if ($role === 'admin') {
        return view('dashboard.admin');
    } elseif (in_array($role, ['user', 'operator'])) {
        


// Ambil tabungan dengan status proses, pengambilan, sampai
$tabungproses = DB::table('tabungan')
->join('users', 'tabungan.user_id', '=', 'users.id')
->whereIn('tabungan.status', ['proses','pengambilan','sampai'])
->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
->get();

// Ambil tabungan dengan status sampai, inputdata




// Ambil semua data jenis mutasi (buat select option di form)
$user = Auth::user();
$tabungan = tabungan::where('user_id',$user->id)->get();
$tabungtotalreq = tabungan::where('status', 'proses')->count();
$Nominal = Mutasi::whereHas('tabungan', function ($query) {
    $query->where('user_id', auth()->id());
})->whereNotNull('nominal')->sum('nominal');

$tabungtuntas = tabungan::where('status', 'selesai')
                        ->where('operator_id', $user->id)
                        ->count();
$tabungPerBulan = DB::table('tabungan')
    ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
    ->where('status', 'selesai')
    ->where('operator_id', $user->id)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->pluck('total', 'bulan') // hasilnya: [1 => 5, 2 => 3, ...]
    ->toArray();
$totalPerBulan = DB::table('tabungan')
    ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
    ->where('status', 'selesai')
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->pluck('total', 'bulan') // hasilnya: [1 => 5, 2 => 3, ...]
    ->toArray();
 
$tabunganproses = tabungan::where('status',['pengambilan','sampai'])
                        ->where('operator_id', $user->id)
                        ->count();
$saldo = tabungan::where('user_id',$user->id)->sum('saldo'); 
$totalBobot = Tabungan::where('user_id', $user->id)->sum('total_bobot');
$mutasi = Mutasi::whereHas('tabungan', function ($q) {
    $q->where('user_id', auth()->id());
})->latest()->first(); // ambil mutasi terakhir user ini


$chartData = [];
for ($i = 1; $i <= 12; $i++) {
    $chartData[] = $tabungPerBulan[$i] ?? 0;
}

$chartall = [];
for ($i = 1; $i <= 12; $i++) {
    $chartall[] = $totalPerBulan[$i] ?? 0;
}


return view('pages.nasabah.dashuser', [
'tabungproses' => $tabungproses,
'saldo'=>$saldo,
'Nominal'=>$Nominal,
'tabungan'=>$tabungan,
'totalPerBulan'=>$totalPerBulan,
'chartall'=>$chartall,
'tabungPerBulan'=>$tabungPerBulan,
'tabunganproses'=>$tabunganproses,
'chartData'=>$chartData,
'tabungtotalreq'=>$tabungtotalreq,
'tabungtuntas'=>$tabungtuntas,
'totalbobot'=>$totalBobot,
'mutasi'=>$mutasi
]);    
    }
abort(403); 

}    

public function admin(){

$tabungjadi = DB::table('tabungan')
            ->join('users', 'tabungan.user_id', '=', 'users.id')
            ->whereIn('tabungan.status', ['selesai'])
            ->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
            ->get();
$tabunginput = DB::table('tabungan')
->join('users', 'tabungan.user_id', '=', 'users.id')
->whereIn('tabungan.status', ['inputdata'])
->select('tabungan.*', 'users.name as nama_user','users.alamat as alamat_user')
->get();
$jenismutasi = DB::table('jenismutasi')->select('id', 'nama_sampah', 'harga')->get();
$pendapatanPerJenis = DB::table('mutasi')
->join('jenismutasi', 'mutasi.jenismutasi_id', '=', 'jenismutasi.id')
->select('jenismutasi.nama_sampah as jenis', DB::raw('SUM(mutasi.bobot) as total'))
->groupBy('jenismutasi.nama_sampah')
->pluck('total', 'jenis')
->toArray();
$bobotabung = tabungan::sum('total_bobot');
$totalsaldo = tabungan::sum('saldo');
$pelanggan = user::where('role','user')->count();



$grafikBobotBulanan = DB::table('tabungan')
    ->selectRaw('MONTH(created_at) as bulan, SUM(total_bobot) as total_bobot')
    ->where('status', 'selesai') // filter kalau perlu
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->pluck('total_bobot', 'bulan') // hasilnya: [1 => 120, 2 => 200, ...]
    ->toArray();

// Biar urut dari Jan - Des
$finalBobotBulanan = [];
for ($i = 1; $i <= 12; $i++) {
    $finalBobotBulanan[] = $grafikBobotBulanan[$i] ?? 0;
}

    return view('pages.admin.list',[
        'tabungjadi'=>$tabungjadi,
        'tabunginput' => $tabunginput,
        'jenismutasi' => $jenismutasi,
        'pendapatanPerJenis' => $pendapatanPerJenis,
        'bobotabung'=>$bobotabung,
        'finalBobotBulanan'=>$finalBobotBulanan,
        'totalsaldo'=>$totalsaldo,
        'pelanggan'=>$pelanggan,


    ]);
}

public function profile(){
$user = Auth::user();
$tabungan = tabungan::where('user_id',$user->id)->get();
 return view('profile.edit',compact('tabungan'));
}
public function detailjemput($id){
    $tabungana = tabungan::find($id);
    return view('pages.operator.pengambilan',compact('tabungana'));
}

}
