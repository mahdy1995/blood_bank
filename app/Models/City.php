<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'governorate_id');
    protected $with = array('governorate');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    public function donation()
    {
        return $this->hasMany('App\Models\BloodRequest');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

}
