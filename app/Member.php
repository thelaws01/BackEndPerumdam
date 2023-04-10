<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    protected $table = 'member';
    protected $fillable =
    [
    	 	'nama',
            'akses_id',
            'nik',
            'phone',
            'foto',
            'ttl',
            'alamat',
            'username',
            'password',
            'plain',
            'fcm_id',
    ];	
    
    public function getJWTIdentifier() {
        return $this->getKey();
    }
  
    public function getJWTCustomClaims() {
        return [];
    }    

    public function scopeUsername($query, $string) 
    {
        return $query->whereUsername($string);
    }

    public function scopePlain($query, $string) 
    {
        return $query->wherePlain($string);
    }

    public function aduan()
    {
        return $this->hasMany(Pengaduan::class, 'member_id');
    }
}
