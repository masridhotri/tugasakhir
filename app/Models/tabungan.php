<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tabungan extends Model
{
    use HasFactory;
    protected $table = 'tabungan';

    protected $fillable = [
        'user_id',
        'total_bobot',
        'saldo',
        'status',
        'hapusdata',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Mutasi
    public function mutasi()
    {
        return $this->hasMany(mutasi::class);
    }
}
