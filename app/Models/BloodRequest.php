<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{

    protected $table = 'blood_requests';
    public $timestamps = true;
    protected $fillable = array
    (
        'client_id',
        'mobile',
        'patient_name',
        'patient_age',
        'blood_type',
        'bag_num',
        'hospital_name',
        'hospital_address',
        'city_id',
        'notes',
        'latitude',
        'longitude'
    );

    public function notification()
    {
        return $this->hasMany('App\Models\Notification');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
