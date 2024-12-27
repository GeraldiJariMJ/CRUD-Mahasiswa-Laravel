<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kelas_id', 'kode_dosen', 'nip', 'name',
    ];

    static public function getDosen(){
        return self::select('dosens.*')
        ->orderBy('id','asc')
        ->get();        
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getKelasList()
    {
        return self::select('dosens.*', 'users.name as nama', 'users.email', 'users.role', 'kelas.name as kelas_name')
            ->join('users', 'users.id', '=', 'dosens.user_id') // Inner join dengan tabel users
            ->join('kelas', 'kelas.id', '=', 'dosens.kelas_id') // Inner join dengan tabel kelas
            ->orderBy('dosens.id', 'asc')
            ->get();
    }
}
