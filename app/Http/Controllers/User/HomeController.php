<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Trademark;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;
session_start();
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;



class HomeController
{

    public function index(){
        $product_sellings = Product::orderBy('sold', 'DESC')->limit(8)->get();
        $product_news = Product::orderBy('created_at', 'DESC')->limit(8)->get();
        return view('user.home')->with([
            'product_sellings' => $product_sellings,
            'product_news' => $product_news,
        ]);
    }

    public function search(Request $request){
        session()->regenerate();
        if($request->has('keywords')){
            Session::put('keywords',$request->keywords);
        }
        $keyword = Session::get('keywords');;
        $category = Category::orderBy('name', 'DESC')->limit(8)->get();
        $trademark = Trademark::orderBy('name', 'DESC')->limit(8)->get();

        $search_product = Product::where('name','like','%'.$keyword.'%')->get();
        return view('user.product.search')->with([
            'keyword' => $keyword,
            'search_product' => $search_product
        ]);
    }
    

    public function listProduct(Request $request){

        //Lọc theo giá
        $min = 0;
        $max = 0;
        $products = Product::orderBy('created_at', 'DESC')->get();
        $trademarks = Trademark::orderBy('name', 'DESC')->get();
        if (isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan'){
                $products = Product::orderBy('sale_price', 'DESC')->paginate(24);
            } elseif ($sort_by == 'tang_dan'){
                $products = Product::orderBy('sale_price', 'ASC')->paginate(24);
            } elseif ($sort_by == 'kytu_az'){
                $products = Product::orderBy('name', 'ASC')->paginate(24);
            } elseif ($sort_by == 'kytu_za'){
                $products = Product::orderBy('name', 'DESC')->paginate(24);
            }
        }elseif (isset($_GET['amount_start']) && ($_GET['amount_end'])){
            $min = $_GET['amount_start'];
            $max = $_GET['amount_end'];
            $products = Product::whereBetween('sale_price', [$min, $max])->orderBy('sale_price', 'ASC')->paginate(9);
        }elseif (isset($_GET['trademark'])){
            $filter_trademark = $_GET['trademark'];
            $trademark_arr = explode(",", $filter_trademark);
            $products = Product::whereIn('trademark_id', $trademark_arr)->orderBy('created_at', 'desc')->paginate(9)
            ->appends(request()->query());

        }else{
            $products = Product::orderBy('created_at', 'desc')->paginate(9);
        }

        $trademark_name = Trademark::orderBy('name', 'DESC')->get();


        return view('user.product.all')->with([
           'products' => $products,
           'amount_start' => $min,
           'amount_end' => $max,
           'trademarks' => $trademarks,
           'trademark_name' => $trademark_name
        ]);
    }

    public function show($id){
        $product = Product::where('id',$id)->with(['category','images','trademark'])->first();
        
        $product_news = Product::orderBy('created_at', 'DESC')->limit(4)->get();
        $cate_product = Category::orderBy('id', 'DESC')->get();
        $trademark_product = Trademark::orderBy('id', 'DESC')->get();

        $rating = Rating::where('product_id',$id)->avg('rating');
        $rating = round($rating);
        $comment = Comment::with('user')->where('product_id',$id)->get();
        return view('user.product.detail')->with([
            'product' => $product,
            // 'related' => $related_product,
            'product_news' => $product_news,
            'rating'=>$rating,
            'comment'=>$comment
        ]);

        $items = Cart::content();
        return view('user.product.cart')->with([
            'items' => $items,
        ]);

    }

    public function checkout(){
        $city = City::orderby('matp','ASC')->get(); 

        if (Auth::check()){
            $items = Cart::content();
            return view('user.checkout.index')->with([
                'products' => $items,
                'city' => $city
            ]);
        }else{
            return redirect()->route('user.login.form');
        }

        $city = City::orderby('matp','ASC')->get();
    }

    public function selectDeliverHome(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Ward::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->user_id = Auth::guard('web')->user()->id;
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
    public function comment_product(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->user_id = $data['user_id'];
        $comment->product_id = $data['product_id'];
        $comment->name = $data['name_comment'];
        $comment->email = $data['email_comment'];
        $comment->content = $data['content_comment'];
        $comment->save();
        echo 'done';
    }
}
