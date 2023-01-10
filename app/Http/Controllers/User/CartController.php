<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Coupon;
use Carbon\Carbon;
use Session;
session_start();
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(!Session::get('is_use_coupon')){
            Session::forget('coupon');
        };
        
        $items = Cart::content();
        return view('user.product.cart')->with([
            'items' => $items,
        ]);
    }

    //check mã giảm giá
    function checkcoupon(Request $request){
        // dd(1);
        $data = $request->all();
        $now = Carbon::now();
        
        $coupon = Coupon::where('coupon_code',$data['coupon'])
                        ->where('remaining', '>', 0)
                        ->first();
                        // dd($coupon->start_time);       
        $coupon_start = Carbon::createFromFormat('Y-m-d',$coupon->start_time);
        $coupon_end = Carbon::createFromFormat('Y-m-d',$coupon->end_time);
    
        if ($coupon && $coupon_start<=$now && $now<$coupon_end) {
            $coupon->remaining = $coupon->remaining - 1;
            $coupon->save();

            $cou[] = array(
                'coupon_code' => $coupon->coupon_code,
                'coupon_condition' => $coupon->coupon_condition,
                'coupon_number' => $coupon->coupon_number,
            );
            Session::put('coupon',$cou);
            Session::put('is_use_coupon',true);
            Session::save();

            return redirect()->back()->with('message','Thêm mã giảm giá thành công');
        } else {
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
        }
    }

    public function add(Request $request, $id=null){
        $qty = $request->input('qty');
        if(empty($qty)){
            $qty = 1;
        }
        $product = Product::find($id);
        Cart::add($product->id, $product->name, $qty, $product->sale_price, 0, ['image' => $product->images[0]->path]);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    

    public function increment($rowId){
        $cart = Cart::get($rowId);
        $product = Product::find($cart->id);
        if($cart->qty+1<=$product->quantity){
            Cart::update($rowId, $cart->qty+1);
        }
        return redirect()->route('user.product.cart');
    }

    public function decrement($rowId){
        $cart = Cart::get($rowId);
        if($cart->qty-1>=env('MIN_BUY')){
            Cart::update($rowId, $cart->qty-1);
        }
        return redirect()->route('user.product.cart');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function remove($id){
        Cart::remove($id);
        return redirect()->route('user.product.cart');
    }

    public function destroy($id)
    {
        Cart::destroy();
        return redirect()->route('user.product.cart ');
    }
}