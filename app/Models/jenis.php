<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    use HasFactory;
    protected $table = 'jenismutasi'; // optional, hanya kalau mau eksplisit

    protected $fillable = ["nama_sampah","harga","foto","deskripsi"];

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($jenis) {
            // Path gambar di dalam folder public/file/
            $imagePath = public_path('file/' . $jenis->foto);

            // Hapus file jika ada
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        });
    }
    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
}
