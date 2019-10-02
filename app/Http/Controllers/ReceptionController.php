<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionController extends Controller
{
    public function index(){
        $date = Reception::where('user_id', Auth::user()->id)->first();
        if (!$date){
            $date = 0;
        }
        return view('reception.reception', compact('date'));
    }

    public function reception_time(Request $request){
        $dates = explode(', ', $request->dates);

        return view('reception.reception-time', compact('dates'));
    }

    public function create_reception(Request $request){
        $this->validate($request , [
            'user_id' => 'required',
            'date' => 'required',
        ]);

        $input = $request->all();
        $arr = explode(' ' , $request->date);
        $input['date'] = $arr[0];
        $input['time'] = $arr[1];

        Reception::create($input);

        /* Mail */

        return redirect()->route('reception');

    }

    public function print_coupon($id){
        $reception = Reception::find($id);
        $user = Auth::user();
        if($reception->user_id != $user->id && !$user->hasRole('Moderator') ){
            abort(404);
        }
        return view('reception.print-coupon' , compact('reception', 'user'));
    }

    public function coupon_upload(Request $request){
        $input = $request->all();

        $arr = explode(' ' , $request->date);
        $input['date'] = $arr[1];
        $input['time'] = $arr[2];

        $reception = Reception::where('date' , $arr[1])->where('time', $arr[2])->first();
        $reception->update($input);
        return redirect()->back();
    }

}
