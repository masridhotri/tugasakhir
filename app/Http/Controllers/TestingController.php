<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function first(){
        return view('pages.nasabah.mutasiuser');
    }
    public function seccond(){
        return view('pages.nasabah.riwayatsetor');
    }
    public function tiga(){
        return view('pages.nasabah.setorsampah');
    }
    public function empat(){
        return view('pages.operator.list');
    }
     public function lima(){
        return view('pages.operator.pengambilan');
    }
    public function enam(){
        return view('pages.operator.riwayat');
    }
    public function tujuh(){
        return view('pages.admin.management');
    }

    function dahsur(){
        return view('dashboard');
    }

    function admin(){
        return view('pages.nasabah.dashuser');
    }
    
}
