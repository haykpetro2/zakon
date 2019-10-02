<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function new_password($user_id , $token)
    {
        $user = DB::table('users')->where([
            ['id', '=', $user_id],
            ['reset_token', '=', $token],
        ])->first();
        if($user){
            return view('auth.passwords.reset' , ['user_id' => $user_id]);
        }else{
            abort(404);
        }
    }

    public function new_pass(Request $request , $user_id)
    {
        $validator = Validator::make($request->all(), ['password' => ['required', 'string', 'min:4', 'confirmed'],]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $hashed = Hash::make($request->password);
        DB::table('users')
            ->where('id', $user_id)
            ->update(['password' => $hashed]);
        return redirect()->route('home');
    }

}
