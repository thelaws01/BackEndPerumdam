<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    
    protected $guarded = [];

     public function aduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}
