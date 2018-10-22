<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate;
use App\City;
use App\BloodRequest;
use App\Category;

class MainController extends Controller
{
    public function governorates()
    {
        $governorates = Governorate::all();

        return responseJson(1, 'Success',$governorates );
    }

    public function cities(Request $request)
    {
        $cities = City::where(function ($query) use($request){
            if($request->has('governorate_id'))
            {
                $query->where('governorate_id',$request->governorate_id);
            }
        })->get();

        return responseJson(1, 'Success',$cities );
    }

    public function categories()
    {
        $categories = Category::all();

        return responseJson(1, 'Success',$categories );
    }

    public function articles(Request $request)
    {
        $articles = Article::where(function ($query) use($request){
            if($request->has('title'))
            {
                 $query->where('title',$request->title);
                //foreach ($request as $value) {
                //    $query->orwhere('title', 'like', "%[$value]%");
                //}
                return responseJson(1, 'Success');
            }else
                {
                $articles = Article::all();

                return responseJson(0, 'Success',$articles );
            }
        })->paginate(3);

        return responseJson(1, 'Success',$articles );
    }

    public function fav_articles(Request $request){

    }

    public function blood_requests(Request $request)
    {
        $blood_requests = BloodRequest::where(function ($query) use($request){
            if($request->has('city_id'))
            {
                $query->where('city_id',$request->city_id);
            }else
                {
                $blood_requests = BloodRequest::latest();

                return responseJson(1, 'Blood Requests', $blood_requests);
            }
        })->paginate(8);

        return responseJson(1,'Success', $blood_requests);
    }
};
