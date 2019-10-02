<?php

namespace App\Http\Controllers;

use App\Info;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function vacancies(Request $request){
        $this->validate($request, [
            'name' => 'required_without_all:phone,email',
            'phone' => 'required_without_all:name,email',
            'email' => 'required_without_all:name,phone',
        ]);

        $data = $request->all();
        Mail::send('mail.vacancy', $data, function($message) {
            $form_email = Info::where('name', 'Email From')->first();
            $message->to($form_email->value, 'Vacancy')->subject('Vacancy message');
            $message->from('examplte@gmail.com','Закон Прост');
        });
        return redirect()->back()->with('success', 'Отправлено');
    }

    public function send_problem(Request $request){
        $this->validate($request, [
            'login' => 'required',
            'problem' => 'required',
        ]);

        $data = $request->all();
        Report::create($data);
        if($request->user){
            $user = User::find($request->user);
            $data['user'] = $user->first_name . ' ' . $user->last_name . ' (' . $user->id . ')';
        }

        Mail::send('mail.report', $data, function($message) {
            $form_email = Info::where('name', 'Email From')->first();
            $message->to($form_email->value, 'Problem')->subject('Problem message');
            $message->from('examplte@gmail.com','Закон Прост');
        });

        return redirect()->back()->with('success', 'Отправлено');
    }

}
