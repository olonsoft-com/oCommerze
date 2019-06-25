<?php

namespace App\Http\Controllers;

use App\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
//        $gUsers = DB::select("SELECT * FROM guest_users WHERE user_status='verified' and user_schedule_code is null");
//        $users = DB::select("SELECT * FROM users");
        $id = Auth::user()->id;
        $guestUser = GuestUser::where(['user_artist_id'=>$id, 'user_status'=>'serving'])->first();
        //dd($guestUser);
        return view('admin.guest.guest-list')->with('guestUser', $guestUser);
    }

    public function showAllGuestList()
    {
        $guestUser = GuestUser::all();
        return view('admin.admin-guest.guest-list')->with('userList', $guestUser);
    }

    function sendScheduleSMS(Request $request){
        try {

            $artist_id = $request->get('artist');
            $guestId = $request->get('guest_id');

            $res = [
                'status' => trans('custom.status.failed'),
                'msg' => trans('custom.msg.invalid'),
                'data' => [],
            ];
            $guser = GuestUser::where('id', $guestId)->first();
            $guestUsers = DB::select("select * from guest_users where user_schedule_code IS NOT NULL order by created_at desc limit 1");
            $sCode = 0;

            if(count($guestUsers)>0)
                $sCode +=0;
            else
                $sCode +=1001;


            if($guser !== null){

                $guser->user_status = 'on-going';
                $guser->user_artist_id = $artist_id;
                $guser->user_artist_token_no = 1;
                $guser->user_schedule_code = $sCode;
                $guser->save();

                $res = [
                    'status' => trans('custom.status.success'),
                    'msg' => trans('custom.msg.dataSuccess'),
                    'data' => $guser->toArray(),
                ];

                $sms = new SMSService();
                $sms->sendScheduleSMS($guser->user_mobile, $sCode, $guser->user_artist_token_no);

            }



        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => [
                    'label' => "danger",
                    'content' => 'SMS cannot be sent.'
                ]
            ]);

        }

        return redirect()->back()->with([
            'message' => [
                'label' => "success",
                'content' => 'SMS has been sent.'
            ]
        ]);
    }
    function serve(Request $request){
        if(Auth::user()->user_working_status == null){
            $gUser = GuestUser::where(['user_status'=>'verified'])->first();
            $guestUsers = DB::select("select * from guest_users where user_schedule_code IS NOT NULL order by created_at desc limit 1");
            $sCode = 0;

            if(count($guestUsers)>0)
                $sCode +=0;
            else
                $sCode +=1001;
            $sms = new SMSService();
            if($gUser != null){
                $sms->sendScheduleSMS($gUser->user_mobile, $sCode, Auth::user()->counter);
                $gUser->user_status = 'serving';
                $gUser->user_artist_id = Auth::user()->id;
                $gUser->user_schedule_code = $sCode;
                $gUser->user_artist_token_no = Auth::user()->counter;
                $gUser->user_artist_id = Auth::user()->id;
                $gUser->save();

                $currUser = Auth::user();
                $currUser->user_working_status = 'serving';
                $currUser->save();

                return redirect()->route('guest.index')->with([
                    'message' => [
                        'label' => "success",
                        'content' => 'Availble user has been sent sms.'
                    ]
                ]);
            }else{
                return redirect()->route('guest.index')->with([
                    'message' => [
                        'label' => "danger",
                        'content' => 'No available user.'
                    ]
                ]);
            }
        }else{
            return redirect()->route('guest.index')->with([
                'message' => [
                    'label' => "danger",
                    'content' => 'Your running task availble. can not serve others.'
                ]
            ]);
        }

    }

    function tokenVerify(Request $request){
        $guestId = $request->get('guest_id');
        $guestToken = $request->get('token');

        $user = GuestUser::where(['id'=>$guestId])->first();
        //dd($guestToken);
        if($user->user_schedule_code == $guestToken){
            $user->user_token_verify = $guestToken;
            $user->user_status = 'serving';
            $user->save();

            return redirect()->route('guest.index')->with([
                'message' => [
                    'label' => "success",
                    'content' => 'Token verify success.'
                ]
            ]);
        }else{
            return redirect()->route('guest.index')->with([
                'message' => [
                    'label' => "danger",
                    'content' => 'Token not match.'
                ]
            ]);
        }
    }

    function scheduleComplete(Request $request){
        $artistId = $request->get('artist_id');
        $guestId = $request->get('guest_id');
        $user = GuestUser::where(['id'=>$guestId])->first();

        if($user !== null){
            $user->user_status = 'completed';
            $user->save();

            $currUser = Auth::user();
            $currUser->user_working_status = null;
            $currUser->save();

            return redirect()->route('guest.index')->with([
                'message' => [
                    'label' => "success",
                    'content' => 'Guest user task compeled'
                ]
            ]);

        }else{
            return redirect()->route('guest.index')->with([
                'message' => [
                    'label' => "danger",
                    'content' => 'OPPS! something went wrong.'
                ]
            ]);
        }
    }

    function getComList(){
        $user = GuestUser::where(['user_artist_id'=>Auth::user()->id,'user_status'=>'completed'])->get();
//        dd($user[0]->id);
        return view('admin.guest.com-list')->with('userList', $user);
    }
}
