<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{

    protected $table = 'blood_type';
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
