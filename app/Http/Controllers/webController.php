<?php

namespace App\Http\Controllers;

use App\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;

class webController extends Controller
{
    public function guestUserStore(Request $request)
    {
        try {


        $input = $request->input();
            $validator = Validator::make($request->all(), [
            'user_first_name' => 'required|max:255',
            'user_last_name' => 'required|max:255',
            'user_email' => 'required|email|unique:guest_users',
            'user_mobile' => 'string|unique:guest_users'
        ]);

            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
            DB::beginTransaction();
                $digits = 4;
                $randomCode = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $guestUserTbl = GuestUser::Create([
                'user_first_name' => $request->get('user_first_name'),
                'user_last_name' => $request->get('user_last_name'),
                'user_mobile' =>$request->get('user_mobile'),
                'user_email' =>$request->get('user_email'),
                'user_verify_code' => $randomCode,
                ]);

            DB::commit();


            $res = [
                'status' => trans('custom.status.success'),
                'msg' => trans('custom.msg.dataSuccess'),
                'data' => $guestUserTbl->toArray(),
            ];

            $smsService = new SMSService();
            $sms = $smsService->sendOTPSMS($request->get('user_mobile'), $randomCode);

        }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $res = [
                'status' => trans('custom.status.dbInsertError'),
                'msg' => trans('custom.msg.invalid'),
                'errors' => [$e->getLine(), $e->getMessage(), $e->getFile()]

            ];

        }
//        return back()->with("success", "Saved SuccessFull");
        return redirect('/guest/user/otp');
    }

    function getGuestConfirm(){
        return view('guest_user_otp');
    }

    public function guestConfirm(Request $request)
    {

        try {
            $otpcode = $request->input('user_otp_verify');
            $guser = GuestUser::where('user_verify_code', $otpcode)->first();
            if($guser !== null){
                $guser->user_status = 'verified';
                $guser->user_verify_code = md5(time() . uniqid() . time() . rand(11111111, 99999999));
                $guser->save();
                return back()->with("success", "Successfully submited.");
            }else{
                return back()->with("errors", "OTP not match");
            }
        } catch (\Exception $e) {
            dd($e->getMessage());

        }
    }

}
