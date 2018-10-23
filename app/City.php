<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'governorate_id');
    protected $with = array('governorate');

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }
    public function donation()
    {
        return $this->hasMany('App\BloodRequest');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }

}
