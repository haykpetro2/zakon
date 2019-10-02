<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/office';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => ['unique:users','required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $first = substr($data['password'], 0 , 1);
        $last = substr($data['password'], -1);
        $password_settings = $first.'******'.$last;
        $user = User::create([
            'login' => $data['login'],
            'code' => $data['code'],
            'password' => Hash::make($data['password']),
            'password_settings' => $password_settings,
        ]);

        $user->assignRole('User');

        return $user;

    }

    public function phone_view($id){
        $user = User::find($id);
        return view('auth.register-phone' , compact('user'));
    }

    public function register_phone(Request $request){
        $validator = $this->validate($request, [
            'login' => 'required|unique:users',
            'code' => 'required',
            'password' => 'required|confirmed|min:4',
        ]);

        $first = substr($request->password, 0 , 1);
        $last = substr($request->password, -1);
        $password_settings = $first.'******'.$last;

        $user = User::find($request->user_id);
        $user->update([
            'login' => $request->login,
            'code' => $request->code,
            'password' => Hash::make($request->password),
            'password_settings' => $password_settings,
        ]);

        $user->assignRole('User');

        $credentials = [
            'login' => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('chat');
        }

    }
}
