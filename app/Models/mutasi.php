<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi extends Model
{
    use HasFactory; 
    protected $table = 'mutasi';

    protected $fillable = [
        'tabungan_id',
        'jenismutasi_id',
        'bobot',
        'total_harga',
        'nominal',
        'admin_id',
        'hapusdata',
    ];

    // Relasi ke Tabungan
    public function tabungan()
    {
        return $this->belongsTo(tabungan::class);
    }

    // Relasi ke Jenis Mutasi
    public function jenisMutasi()
    {
        return $this->belongsTo(jenis::class, 'jenismutasi_id');
    }

    // Relasi ke Admin (User)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

