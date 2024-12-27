<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'jumlah',
    ];

    static public function getKelas(){
        return self::select('kelas.*')
        ->orderBy('id','asc')
        ->get();        
    }


    static public function getSingle($id){
        return self::find($id);
    }

    public function sisaKapasitas()
    {
        // Ambil jumlah mahasiswa yang terdaftar di kelas ini
        $jumlahMahasiswa = Mahasiswa::where('kelas_id', $this->id)->count();
        
        // Hitung sisa kapasitas
        return 10 - $jumlahMahasiswa; // Misalkan kapasitas maksimal adalah 10
    }

    public static function getListKelas()
    {
        // Mengambil semua kelas dan menghitung sisa kapasitas
        return self::withCount(['mahasiswas as mahasiswa_count']) // Hitung jumlah mahasiswa
            ->select('kelas.*')
            ->get()
            ->map(function ($kelas) {
                // Menghitung sisa kapasitas
                $kelas->sisa_kapasitas = 10 - $kelas->mahasiswa_count; // Misal kapasitas maksimal 10
                return $kelas;
            });
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(Dosen::class, 'kelas_id');
    }


    static public function getKelasList()
    {
        return self::select('kelas.*', 'dosens.name as dosen_name', 'users.name as user_name', 'users.email', 'users.role')
            ->join('dosens', 'dosens.kelas_id', '=', 'kelas.id') // Inner join dengan tabel dosens
            ->join('users', 'users.id', '=', 'dosens.user_id') // Inner join dengan tabel users melalui dosens
            ->withCount(['mahasiswas as mahasiswa_count']) // Hitung jumlah mahasiswa
            ->orderBy('kelas.id', 'asc')
            ->get()
            ->map(function ($kelas) {
                // Menghitung sisa kapasitas
                $kelas->sisa_kapasitas = 10 - $kelas->mahasiswa_count; // Misal kapasitas maksimal 10
                return $kelas;
            });
    }
}
