<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Transport;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user','customer'])->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function  getList(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($orders) {
                if($orders->status == Order::WAIT) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 text-warning confirmOrder"
                         style="cursor:pointer;text-decoration: none; padding 2px"
                         tooltip="Xác nhận" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fa-solid fa-circle-check"></i>
                      </a>
                       <a
                            data-id="'.$orders->id.'"
                            style="color: red; cursor:pointer;text-decoration: none"
                            class="menu-link px-3 cancelOrder" data-token="{{csrf_token()}}"
                            tooltip="Huỷ" flow="up">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                        <a
                            href="'.route("admin.orders.detailOrder",["id" => $orders->id]).'"
                            style="color: green; cursor:pointer;text-decoration: none"
                            class="menu-link px-3 viewDetail" data-token="{{csrf_token()}}"
                            tooltip="Xem chi tiết" flow="up">
                            <i class="fa-solid fa fa-eye"></i>
                        </a>
                    ';
                } else if($orders->status == Order::CONFIRM) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 text-primary shipping"
                         style="cursor:pointer;text-decoration: none"
                         tooltip="Giao hàng" flow="up" data-token="{{csrf_token()}}">
                        <i class="fa-solid fa-truck"></i>
                      </a>
                       <a
                            data-id="'.$orders->id.'"
                            style="color: red; cursor:pointer;text-decoration: none;"
                            class="menu-link px-3 cancelOrder" data-token="{{csrf_token()}}"
                            tooltip="Huỷ" flow="up">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                        <a
                            href="'.route("admin.orders.detailOrder",["id" => $orders->id]).'"
                            style="color: green; cursor:pointer;text-decoration: none"
                            class="menu-link px-3 viewDetail" data-token="{{csrf_token()}}"
                            tooltip="Xem chi tiết" flow="up">
                            <i class="fa-solid fa fa-eye"></i>
                        </a>
                    ';
                } else if($orders->status == Order::SHIPPING) {
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 complete"
                         style="cursor:pointer;color: mediumpurple;text-decoration: none"
                         tooltip="Đã giao" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fas fa-calendar-check"></i>
                      </a>
                      <a
                            data-id="'.$orders->id.'"
                            style="color: red; cursor:pointer;text-decoration: none;"
                            class="menu-link px-3 cancelOrder" data-token="{{csrf_token()}}"
                            tooltip="Huỷ" flow="up">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </a>
                      <a
                            href="'.route("admin.orders.detailOrder",["id" => $orders->id]).'"
                            style="color: green; cursor:pointer;text-decoration: none"
                            class="menu-link px-3 viewDetail" data-token="{{csrf_token()}}"
                            tooltip="Xem chi tiết" flow="up">
                            <i class="fa-solid fa fa-eye"></i>
                        </a>
                    ';
                } else if($orders->status == Order::REQUESTCANEL){
                    return '
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 cancelOrder"
                         style="cursor:pointer;color: red;text-decoration: none"
                         tooltip="Xác nhận huỷ" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fas fa-calendar-times"></i>
                      </a>
                      <a
                         data-id="'.$orders->id.'"
                         class="menu-link px-3 complete"
                         style="cursor:pointer;color: mediumpurple;text-decoration: none"
                         tooltip="Đã giao" flow="up"  data-token="{{csrf_token()}}">
                        <i class="fas fa-calendar-check"></i>
                      </a>
                      <a
                            href="'.route("admin.orders.detailOrder",["id" => $orders->id]).'"
                            style="color: green; cursor:pointer;text-decoration: none"
                            class="menu-link px-3 viewDetail" data-token="{{csrf_token()}}"
                            tooltip="Xem chi tiết" flow="up">
                            <i class="fa-solid fa fa-eye"></i>
                        </a>
                    ';
                }else{
                    return '
                    <a
                        href="'.route("admin.orders.detailOrder",["id" => $orders->id]).'"
                        style="color: green; cursor:pointer;text-decoration: none"
                        class="menu-link px-3 viewDetail" data-token="{{csrf_token()}}"
                        tooltip="Xem chi tiết" flow="up">
                        <i class="fa-solid fa fa-eye"></i>
                    </a>
                    ';
                }
            })
            ->editColumn('status', function ($orders) {
                if($orders->status == Order::WAIT)
                {
                    return '<span style="background: orange;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::CONFIRM)
                {
                    return '<span style="background: dodgerblue;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::CANCEL)
                {
                    return '<span style="background: darkgray;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::SHIPPING)
                {
                    return '<span style="background: plum;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }
                else if($orders->status == Order::COMPLETE)
                {
                    return '<span style="background: greenyellow;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }else{
                    return '<span style="background: red;border-radius: 5px;padding: 0 2px" >'.$orders->status_text.'</span>';
                }

            })
            ->editColumn('update_by', function ($orders) {
                if ($orders->user){
                    return '<b>'.$orders->user->name.'</b>';
                }else {
                    return '<b></b>';
                }
            })
            ->editColumn('customer_id', function ($orders) {
                if(!empty($orders->customer))
                {
                    return '<a href="#" style="text-decoration: none"><b>'.$orders->customer->name.'</b></a>';
                }
            })
            ->editColumn('created_at', function ($orders) {
                return '<b>'. date("H:i | d/m/Y", strtotime($orders->created_at)).'</b>';
            })
            ->editColumn('total', function ($orders) {
                return '<b>'. number_format((int)$orders->total + (int)$orders->fee_ship - (int)$orders->coupon).'</b>';
            })
            ->editColumn('id', function ($orders) {
                return '<a href="#" style="text-decoration: none"><b>'.$orders->id.'</b></a>';
            })
            ->editColumn('payment_text', function ($orders) {
                return '<b>'. $orders->payment_text.'</b>';
            })
            ->rawColumns(['action', 'status','update_by','customer_id','created_at','total','id','payment_text'])
            ->make(true);
    }

    public function orderDetail($id){
            $order = Order::with(['order_details'])->find($id);
            $customer = Customer::find($order->customer_id);
            return view("admin.orders.detail")->with([
                'order' => $order,
                'customer' =>  $customer
            ]);

    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::with(['order_details'])->findOrFail($id);
        $order->status = $request->input('status');

        if( $order->status==Order::COMPLETE){
            foreach($order->order_details as $order_detail){
                $product = Product::find($order_detail->product_id);
                $product->sold += $order_detail->product_quantity;
                $product->quantity -= $order_detail->product_quantity;
                $product->save();
            }
        }


        $order->save();
        if ($order) {
            return response()->json([
                'success' => 'Cập nhật đơn hàng thành công',
            ]);
        }
        return response()->json(['error' => 'Cập nhật đơn hàng thất bại']);
    }

}

