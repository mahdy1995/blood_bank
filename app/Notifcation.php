<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifcation extends Model
{
    protected $table = 'notifcations';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'don_req_id');
}
