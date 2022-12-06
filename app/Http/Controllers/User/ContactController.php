<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ContactController
{

    public function showContact(){
        return view('user.careabout.contact');
    }

    public function save(Request $request){
        dd($request->all());
    }

}
