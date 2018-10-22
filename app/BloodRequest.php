<?php

namespace App;

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

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}
