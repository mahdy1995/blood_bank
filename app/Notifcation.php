<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifcation extends Model 
{

    protected $table = 'notifcations';
    public $timestamps = true;

    public function request()
    {
        return $this->hasOne('App\BloodRequest');
    }

}