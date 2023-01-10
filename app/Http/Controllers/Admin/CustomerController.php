<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function getList(Request $request)
    {
        $customers = Customer::query()->orderBy('created_at','DESC')->get();
        return Datatables::of($customers)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                return '
                <a href="'.route("admin.customers.edit",["id" => $customer->id]).'" style="cursor:pointer;text-decoration: none;" class="menu-link px-3 text-warning" tooltip="Cập nhật tài khoản" flow="up">
                <i class="fa-solid fa-pen-to-square"></i>
                        <a style="cursor:pointer;text-decoration: none;" class="menu-link px-3 text-success reset_pass" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Reset mật khẩu" flow="up">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </a>';
            })
            ->editColumn('status', function ($customer) {
                if ($customer->status == Customer::STATUS_LOCKED){
                    return '
                        <a style="color: red; cursor:pointer;" class="menu-link px-3 change_status" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Mở tài khoản" flow="up">
                            <i class="fa-solid fa-lock text-danger" data-toggle="tooltip" data-placement="top" title="Mở khoá tài khoản"></i>
                        </a>';
                }
                if($customer->status == Customer::STATUS_UNLOCKED){
                    return '
                        <a style="color: red; cursor:pointer;text-align: center" class="menu-link px-3 change_status" data-id="'.$customer->id.'" data-token="{{csrf_token()}}" tooltip="Khoá tài khoản" flow="up">
                        <i class="fa-solid fa-unlock text-primary" data-toggle="tooltip" data-placement="top" title="Khoá tài khoản"></i>
                        </a>';
                }
            })
            ->editColumn('name', function ($customer){
                return '<a href="#" style="text-decoration: none">
                <b>'.$customer->name.'</b>
            </a>';
            })
            ->rawColumns(['action', 'status','name'])
            ->make(true);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit')->with([
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $customer = Customer::findOrFail($id);
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->phone = $data['phone'];
        if($customer->gender){
            $customer->gender = Customer::GENDER_MALE;
        }else{
            $customer->gender = Customer::GENDER_FEMALE;
        }
        $customer->address = $data['address'];
        $customer->save();
        $request->session()->flash('success', 'Cập nhật tài khoản khách hàng thành công');
        return redirect()->route('admin.customers.index');
    }

    public function lock($id)
    {
        $customer = Customer::findOrFail($id);
        if($customer->status){
            $customer->status = Customer::STATUS_LOCKED;
        }else{
            $customer->status = Customer::STATUS_UNLOCKED;
        }
        $customer->save();
        return response()->json([
            'customer_status' =>  $customer->status,
            'status' => 200,
        ]);
    }

    public function resetPassword($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->password = Hash::make(Customer::PASSWORD_DEFAULT);
        $customer->save();
        return response()->json([
            'status' => 200,
        ]);
    }



}
