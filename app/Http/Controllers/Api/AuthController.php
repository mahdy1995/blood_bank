<?php

namespace App\Http\Controllers\Api;

use App\BloodRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Report;


Class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:clients',
                'birth_date' => 'required',
                'blood_type' => 'required|in:O-,O+,A-,A+,B-,B+,AB-,AB+',
                'city_id' => 'required',
                'mobile' => 'required|unique:clients',
                'password' => 'required|min:8|confirmed',
                'last_don_date' => 'required'
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();
        return responseJson(1, 'Registered successfuly', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'mobile' => 'required',
                'password' => 'required',
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('mobile', $request->mobile)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(1, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحه');
            }
        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحه');
        }
        return responseJson(1, '', $auth);
    }

    public function settings(Request $request, client $client)
    {
        $client = Client::update($request->all());
        $client->save();
        return responseJson('1', 'Updated successfuly', $client);
    }

    public function addRequest(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'patient_name' => 'required',
                'patient_age' => 'required',
                'blood_type' => 'required',
                'bag_num' => 'required',
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'city_id' => 'required',
                'mobile' => 'required|unique:blood_requests',
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $blood_requests = BloodRequest::create($request->all());
        $blood_requests->save();
        return responseJson(1, 'تمت الاضافه بنجاح');
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
        $reports->save();
        return responseJson(1, 'Thanks for your feedback');
    }
}
