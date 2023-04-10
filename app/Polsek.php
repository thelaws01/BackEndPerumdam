<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polsek extends Model
{
    protected $table = 'polsek';
    protected $fillable =
    [
    	 	'nama',
            'alamat',
            'phone',
            'photo',
            'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
