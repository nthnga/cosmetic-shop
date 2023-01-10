<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Log;  
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Session;

class CouponController extends Controller
{
    public  function index()
    {
        return view('admin.coupon.index');
    }
    public function getList(Request $request)
    {
        $coupons = Coupon::orderBy('created_at','DESC')->get();
        return Datatables::of($coupons)
            ->addIndexColumn()
            ->editColumn('coupon_name', function ($coupon){
                return '<a href=""><b>'.$coupon->coupon_name.'</b></a>';
            })
            ->addColumn('action', function ($coupon) {
                return '
                     <a href="'.route('admin.coupon.edit', ['id' => $coupon->id]).'"
                       data-placement="top"
                       class="menu-link px-3" data-toggle="tooltip"
                       style="cursor:pointer;text-decoration: none;"
                       tooltip="Chỉnh sửa"
                       flow="up"
                       class="btn btn-xs btn-primary">
                        <i class="fa-solid fa-pen-to-square text-warning"></i>
                     </a>

                    <a
                        style="cursor:pointer; text-decoration: none;"
                        data-id="'.$coupon->id.'" data-token="{{csrf_token()}}"
                        tooltip="Xóa"
                        flow="up"
                        class="menu-link px-3 text-warning delete">
                        <i style="color:red" class="fa-solid fa-trash"></i>
                    </a>
                ';
            })
            

            ->rawColumns(['coupon_name', 'action'])
            ->make(true);

        $coupon = Coupon::orderBy('id','DESC')->get();
        
        return view('admin.coupon.index')>with(compact('coupon','today'));

    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public  function store(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->start_time = $data['start_time'];
        $coupon->end_time = $data['end_time'];
        $coupon->remaining = $data['coupon_times'];

        $coupon->save();
        $request->session()->flash('success','Tạo mới thành công');
        return redirect()->route('admin.coupon.index');
    }

    public  function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit')->with([
            'coupon' => $coupon,
        ]);
    }

    public  function update(Request $request,$id)
    {
        $data = $request->all();
        $coupon = Coupon::findOrFail($id);

        if ($data['coupon_times'] !== $coupon->coupon_times) {
            $coupon->remaining = $data['coupon_times'];
        }
        
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->start_time = $data['start_time'];
        $coupon->end_time = $data['end_time'];

        // Log::info("coupon_times", ['coupon_times' => $data['coupon_times']]);
        // Log::info("message", ['$coupon->coupon_times' => $coupon->coupon_times]);


        $coupon->save();
        $request->session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('admin.coupon.index');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json(['success' => 'Thành công']);
           
    }
}
