<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_date', 'blood_type', 'mobile', 'last_don_date', 'city_id', 'password', 'is_active');
    protected $hidden = array('password', 'api_token');

    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact');
    }

    public function city()
    {
        return $this->hasOne('App\City');
    }

    public function request()
    {
        return $this->hasMany('App\BloodRequest');
    }

    public function blood_type()
    {
        return $this->belongsToMany('App\Blood');
    }

}
