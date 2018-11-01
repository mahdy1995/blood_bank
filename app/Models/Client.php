<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_date', 'blood_type', 'mobile', 'last_don_date', 'city_id', 'password', 'is_active', 'pin_code');
    protected $hidden = array('password', 'api_token');

    public function report()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function contact()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City');
    }

    public function request()
    {
        return $this->hasMany('App\Models\BloodRequest');
    }

    public function blood_type()
    {
        return $this->belongsToMany('App\Models\Blood');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('is_read');
    }

    public function favourites()
    {
        return $this->belongsToMany('App\Models\Article');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

}
