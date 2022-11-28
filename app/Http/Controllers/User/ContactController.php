<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
// use Session;
use App\Http\Requests;

class ContactController
{

    public function showContact(){
        return view('user.careabout.contact');
    }

}
