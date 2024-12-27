<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestIzin extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id', 'mahasiswa_id', 'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
