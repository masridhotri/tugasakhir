<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tabungan;

class OperatorController extends Controller
{
 public function enam(){
 $tabungan = Tabungan::where('operator_id', Auth::id())->get(); 
    return view('pages.operator.riwayat',compact('tabungan'));

 }
}
