<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'category_id', );

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function getThumbnailFullPathAttribute()
    {
        return asset($this->thumbnail);
    }

    public function getIsFavouriteAttribute()
    {
        $favourite = request()->user()->whereHas('favourites',function ($query){
            $query->where('client_article.article_id',$this->id);
        })->first();
        if ($favourite)
        {
            return true;
        }
        return false;
    }
    
    public function favourites()
    {
        return $this->belongsToMany(Client::class);
    }

}
