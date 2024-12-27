<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kelas_id', 'nim', 'name', 'tempat_lahir', 'tanggal_lahir', 'edit'
    ];

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getMhs(){
        return self::select('mahasiswas.*')
        ->orderBy('id','asc')
        ->get();        
    }

    static public function checkKelasCapacity($kelas_id)
    {
        // Hitung jumlah mahasiswa dalam kelas yang diinginkan
        $jumlahMahasiswa = self::where('kelas_id', $kelas_id)->count();
        

        // Batasi jumlah mahasiswa per kelas
        if ($jumlahMahasiswa >= 10) {
            return false; // Kelas penuh
        }
        return true; // Kelas masih bisa menerima mahasiswa
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
