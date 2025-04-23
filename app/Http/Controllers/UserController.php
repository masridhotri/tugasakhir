<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function user() {
        $user = DB::table('users')->get();
        return view('pages.admin.usermanagement', compact('user'));
    }
  
    public function updatedata(Request $request){
        $id = auth()->user()->id;

        DB::table('users')
        ->where('id', $id) // ganti dengan id user yang mau di-update
        ->update([
            'alamat' => $request->input('alamat'),
            'garis_lintang' => $request->input('garis_lintang'),
            'garis_bujur' => $request->input('garis_bujur'),
            'updated_at' => now(),
        ]);
        return redirect('dashboard')->with('success', 'Success create data');

        
    }
}
