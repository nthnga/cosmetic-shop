<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        
        // $request->validate([
        //     'name' => array(
        //         'required',
        //         'min:6',
        //         'max:30',
        //         'regex:/^([aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆfFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTuUùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ]+\s){1,}[aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆfFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTuUùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ]+$/'
        //     ),
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6|max:32',
        //     'address' => 'required',
        //     'gender' => 'required',
        //     'phone' => array(
        //         'required',
        //         'unique:users',
        //         'regex:/^0(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/u'
        //     )
        // ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        // $request->session()->flash('success','Đăng ký tài khoản thành công!');
        return redirect('login')->with('success','Đăng ký tài khoản thành công!');
    
        // return back()->with('success', 'Đăng ký tài khoản thành công.');
    }

    // public function register(Request $request)
    // {
    //     $customer = new Customer();
    //     $customer->name = $request->input('name');
    //     $customer->email = $request->input('email');
    //     $customer->password = Hash::make($request->input('password'));
    //     $customer->status = User::STATUS['ACTIVE'];
    //     $customer->address = $request->input('address');
    //     $customer->gender = (int)$request->input('gender');
    //     $customer->phone = $request->input('phone');
    //     $customer->save();
    //     $request->session()->flash('success','Đăng ký tài khoản thành công!');
    //     return redirect()->route('login');
    // }

}
