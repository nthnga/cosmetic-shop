<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController
{
    public  function index(){
        $orders = Order::with(['order_details'])->where('customer_id',Auth::guard('web')->id())
            ->orderBy('created_at','DESC')->get();
        return view('user.account.index')->with([
            'orders' => $orders
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $customer = Customer::findOrFail($id);
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->address = $data['address'];
        $customer->phone = $data['phone'];
        $customer->save();
        $request->session()->flash('success', 'Cập nhật thông tin tài khoản thành công');
        return redirect()->back();
    }


    public function resetPassword(Request $request, $id)
    {
    
        $customer = Customer::findOrFail($id);
        $customer->password = Hash::make($request->input('newPassword'));
        $customer->save();
        $request->session()->flash('success', 'Cập nhật mật khẩu tài khoản thành công!');
        return redirect()->back();
    }

}
