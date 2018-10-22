<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'category_id');

    public function client()
    {
        return $this->belongsToMany('App\Client');
    }

}