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
        Requesting::create(['content'=>$request->all(), 'service' => 'login']);
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

    public function reset(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $user = Client::where('phone',$request->phone)->first();
        if ($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if ($update)
            {
                // send email
                //  Mail::send('emails.reset', ['code' => $code], function ($mail) use($user) {
                //  $mail->from('app.mailing.test@gmail.com', 'تطبيق باب رزق');
                //  $mail->to($user->email, $user->name)->subject('إعادة تعيين كلمة المرور');
                // });
                return responseJson(1,'برجاء فحص هاتفك',['pin_code_for_test' => $code]);
            }else{
                return responseJson(0,'حدث خطأ ، حاول مرة أخرى');
            }
        }else{
            return responseJson(0,'لا يوجد أي حساب مرتبط بهذا الهاتف');
        }
    }

    public function password(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'confirmed'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $user = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();
        if ($user)
        {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if ($user->save())
            {
                return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            }else{
                return responseJson(0,'حدث خطأ ، حاول مرة أخرى');
            }
        }else{
            return responseJson(0,'هذا الكود غير صالح');
        }
    }

    public function notificationSettings(Request $request)
    {
        if ($request->has('cities'))
        {
            $request->user()->cities()->sync((array)$request->cities);
        }
        if ($request->has('blood_types'))
        {
            $request->user()->bloodTypes()->sync((array)$request->blood_types);
        }
    }

    public function registerToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,ios'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        $data = [
            'status' => 1,
            'msg' => 'تم التسجيل بنجاح',
        ];
        return response()->json($data);
    }

    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        Token::where('token',$request->token)->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم  الحذف بنجاح بنجاح',
        ];
        return response()->json($data);
    }


    public function settings(Request $request, client $client)
    {
        $client = Client::update($request->all());
        $client->save();
        return responseJson('1', 'Updated successfuly', $client);
    }
}
