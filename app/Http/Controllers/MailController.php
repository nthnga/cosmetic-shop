<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Customer;
use App\Models\Coupon;
use Carbon\Carbon;

class MailController extends Controller
{
    public function send_coupon_vip(){
        $customer_vip = Customer::where('customer_vip', '=', NULL)->get;

        echo $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mại ngày".' '.$now;
        $data = [];
        foreach($customer_vip as $vip){
            $data['email'][] = $vip->email;
        }
        Mail::send('mail.sendCoupon1', $data, function ($message) use($title_mail, $data) {
            $message->to($data['email']);
            $message->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return readirect()->back()->with('message', 'Gửi khuyến mãi khách vip thành công');

    }

    public function send_coupon(){
        $customer = Customer::where('customer_vip', 1)->get;

        echo $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mại ngày".' '.$now;
        $data = [];
        foreach($customer as $cus){
            $data['email'][] = $cus->email;
        }
        Mail::send('mail.sendCoupon', $data, function ($message) use($title_mail, $data) {
            $message->to($data['email']);
            $message->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return readirect()->back()->with('message', 'Gửi khuyến mãi khách thành công');

    }

    // public function mail_example(Type $var = null)
    // {
    //     return view('mail.sendCoupon');
    // }
}
