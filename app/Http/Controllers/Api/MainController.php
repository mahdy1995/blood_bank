<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate;
use App\City;
use App\BloodRequest;
use App\Category;
use App\Report;

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

    public function createRequest(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'patient_name' => 'required',
                'patient_age' => 'required:digits',
                'blood_type' => 'required|in:O-,O+,B-,B+,A+,A-,AB-,AB+',
                'bag_num' => 'required:digits',
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'city_id' => 'required|exists:cities,id',
                'mobile' => 'required|unique:blood_requests|digits:11',
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $blood_request = BloodRequest::create($request->all());
        return responseJson(1, 'تمت الاضافه بنجاح', $blood_request);
    }

    public function bloodRequests(Request $request)
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

    public function reports(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'report' => 'required'
            ]);
        if ($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $reports = Report::create($request->all());
        return responseJson(1, 'Thanks for your feedback');
    }

    public function settings()
    {
        return responseJson(1,'loaded',settings());
    }

    public function postFavourite(Request $request)
    {
        RequestLog::create(['content' => $request->all(),'service' => 'donation create']);
        $rules = [
            'post_id' => 'required|exists:posts,id',
        ];
        $validator = validator()->make($request->all(),$rules);
        if ($validator->fails())
        {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $request->user()->favourites()->toggle($request->post_id);
        return responseJson(1,'Success');
    }

    public function myFavourites(Request $request)
    {
        $posts = $request->user()->favourites()->latest()->paginate(20);
        return responseJson(1,'Loaded...',$posts);
    }

    public function logs()
    {
        $requests = RequestLog::latest()->paginate(50);
        return $requests;
    }

    public function notificationsCount(Request $request)
    {
        return responseJson(1,'loaded...',[
            'notifications_count' => $request->user()->notifications()->count()
        ]);
    }
    
    public function notifications(Request $request)
    {
        $items = $request->user()->notifications()->latest()->paginate(20);
        return responseJson(1, 'Loaded...', $items);
    }
};
