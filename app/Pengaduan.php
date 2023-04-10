<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $fillable = 
    [
    		'member_id',
            'kategori_id',
            'user_id',
            'alamat',
            'hari',
            'bentuk',
            'saksi',
            'kerugian',
            'info',
            'foto',
            'status',
            'view'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
