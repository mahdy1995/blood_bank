<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{

    protected $table = 'blood_type';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
