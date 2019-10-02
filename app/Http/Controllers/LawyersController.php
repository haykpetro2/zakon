<?php

namespace App\Http\Controllers;

use App\User;

class LawyersController extends Controller
{

    public function index(){
        $lawyers = User::role('Lawyer')->take(5)->get();
        return view('lawyers', ['lawyers' => $lawyers]);
    }


}
