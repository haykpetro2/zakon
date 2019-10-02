<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        $user = DB::table('users')->where([
            ['login', '=', $request->login],
            ['code', '=', $request->code],
        ])->first();
        if($user != null){
            $reset_token = Str::random(32);
            DB::table('users')
                ->where('id', $user->id)
                ->update(['reset_token' => $reset_token]);
            return redirect()->route('new_password' , ['id' => $user->id , 'token' => $reset_token]);
        }else{
            return redirect()->back()->withErrors(__('auth.wrong_data'));
        }
    }

}
