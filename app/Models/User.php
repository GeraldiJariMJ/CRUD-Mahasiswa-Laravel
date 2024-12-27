<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static public function getSingle($id){
        return self::find($id);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id');
    }

    static public function getAdmin($perPage){
        return self::select('users.*')
        ->where('role','=','kaprodi')
        ->orWhere('role', '=', 'dosen')
        ->orderBy('id','asc')
        ->paginate($perPage);        
    }

    static public function getAdminDosen(){
        return self::select('users.*', 'dosens.kode_dosen', 'dosens.nip', 'dosens.name')
            ->join('dosens', 'users.id', '=', 'dosens.user_id')
            ->where('users.role', '=', 'kaprodi')
            ->orWhere('users.role', '=', 'dosen')
            ->orderBy('users.id', 'asc')
            ->get();
    }

    

}
