<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RequestLog;


Class AuthController extends Controller
{
    public function register(Request $request)
    {
        RequestLog::create(['content' => $request->all(),'service' => 'register']);
        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:clients',
                'birth_date' => 'required|date_format:Y-m-d',
                'blood_type' => 'required|in:O-,O+,A-,A+,B-,B+,AB-,AB+',
                'city_id' => 'required',
                'mobile' => 'required|unique:clients|digits:11',
                'password' => 'required|min:8|confirmed',
                'last_don_date' => 'required|date_format:Y-m-d'
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
}
