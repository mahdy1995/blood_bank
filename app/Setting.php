<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('mobile', 'email');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
