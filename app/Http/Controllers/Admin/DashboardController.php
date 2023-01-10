<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Trademark;
use App\Models\Transport;
use App\Models\Order;
use App\Helpers\Date;
use App\Models\OrderProduct;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;
use Cart;
session_start();


class DashboardController
{
    public function index(){

        $categories = Category::count();
        $products = Product::count();
        $trademarks = Trademark::count();
        $orders = Order::where('status','5')->count();
        $orders=Order::orderByDesc('id')->limit(10)->get();
        $revenue_total = DB::table('statistics')->sum('revenue');
        // dd($revenue_total);

        return view('admin.dashboard', compact('categories','products','trademarks','orders','revenue_total'));
    }


    public function filterByDate(Request $request){

        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date,$to_date])->orderBy('created_at', 'ASC')->get();

        foreach ($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'revenue' => $value->revenue,
                'quantity' => $value->quantity,
                'profit' => $value->profit,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();

        $firstmonthnow = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $firstlastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $endoflastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $week = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == 'week'){
            $get = Statistic::whereBetween('order_date', [$week, $now])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value'] == 'lastmonth'){
            $get = Statistic::whereBetween('order_date', [$firstlastmonth, $endoflastmonth])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value'] == 'thismonth'){
            $get = Statistic::whereBetween('order_date', [$firstmonthnow, $now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date', [$year, $now])->orderBy('order_date','ASC')->get();
        }

        foreach ($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'revenue' => $value->revenue,
                'quantity' => $value->quantity,
                'profit' => $value->profit,
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'revenue' => $value->revenue,
                'quantity' => $value->quantity,
                'profit' => $value->profit,
            );
        }
        echo $data = json_encode($chart_data);
    }
    
    public function confirm_order(Request $request) {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = $today;
        $order->$order_date = $order_date;
        $order->save();

         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $orderproduct = new OrderProduct;
                $orderproduct->product_id = $cart['product_id'];
                $orderproduct->product_name = $cart['product_name'];
                $orderproduct->product_origin_price = $cart['product_origin_price'];
                $orderproduct->product_quantity = $cart['product_qty'];
                $orderproduct->product_coupon =  $data['order_coupon'];
                $orderproduct->product_feeship = $data['order_fee'];
                $orderproduct->save();
            }
         }
         Session::forget('coupon');
         Session::forget('fee');
         Session::forget('cart');
    }
}