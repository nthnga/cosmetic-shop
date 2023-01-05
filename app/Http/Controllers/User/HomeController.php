<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Trademark;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Transport;
use DB;
use Mail;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class HomeController
{

    public function index(Request $request){
        //seo-metagg
        $meta_des = "Mỹ phẩm hàng real. Cosmetic shop!";
        $meta_keywords = "my pham hang auth, mỹ phẩm chất lượng, khuyến mại ";
        $meta_title = "Cosmetic shop mỹ phẩm chất lượng";
        $url_canonical = $request->url();

        $product_sellings = Product::orderBy('sold', 'DESC')->limit(8)->get();
        $product_news = Product::orderBy('created_at', 'DESC')->limit(8)->get();
        $trademarks = Trademark::orderBy('image', 'DESC')->get();
        return view('user.home')->with([
            'product_sellings' => $product_sellings,
            'product_news' => $product_news,
            'meta_des' => $meta_des,
            'meta_keywords' => $meta_keywords,
            'meta_title' => $meta_title,
            'url_canonical' => $url_canonical,
            'trademarks' => $trademarks
        ]);
    }

    public function search(Request $request){
        session()->regenerate();
        $keyword = Session::get('keywords');
        if($request->has('keywords')){
            Session::put('keywords',$request->keywords);
        }
        // $keyword = Session::get('keywords');
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
        $categories = Category::orderBy('created_at', 'DESC')->get();
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

        }elseif (isset($_GET['category'])){
            $filter_category = $_GET['category'];
            $cate_arr = explode(",", $filter_category);
            $products = Product::whereIn('category_id', $cate_arr)->orderBy('created_at', 'desc')->paginate(9)
            ->appends(request()->query());

        }else{
            $products = Product::orderBy('created_at', 'desc')->paginate(9);
        }

        $trademark_name = Trademark::orderBy('name', 'DESC')->get();
        $category_name = Category::orderBy('created_at', 'DESC')->get();

        return view('user.product.all')->with([
           'products' => $products,
           'amount_start' => $min,
           'amount_end' => $max,
           'trademarks' => $trademarks,
           'trademark_name' => $trademark_name,
           'categories' => $categories,
           'category_name' => $category_name,
        ]);
    }

    public function coupon_user(){
        
        $coupons = Coupon::all();
        return view('user.product.coupon')->with([
            'coupons' => $coupons
        ]);
    }

    public function show($id){
        $product = Product::where('id',$id)->with(['category','images','trademark'])->first();
        
        $product_news = Product::orderBy('created_at', 'DESC')->limit(4)->get();
        $cate_product = Category::orderBy('id', 'DESC')->get();
        $trademark_product = Trademark::orderBy('id', 'DESC')->get();

        $rating = Rating::where('product_id',$id)->avg('rating');
        $rating = round($rating);

        //Hien thi danh gia tren form 
        $ratingDashboard = Rating::groupBy('rating')
        ->where('product_id',$id)
        ->select(\DB::raw('count(rating) as count_rating'), \DB::raw('sum(rating) as total'))
        ->addSelect('rating')
        ->get()->toArray();

        $ratingDefaut = $this->mapRatingDefault();
        // dd($ratingDashboard);

        foreach ($ratingDefaut as $key => $item){
            $ratingDefaut[$item['rating']] = $item;
        }
        // dd($ratingDefaut);

        $comment = Comment::with('user')->where('product_id',$id)->get();
        return view('user.product.detail')->with([
            'product' => $product,
            // 'related' => $related_product,
            'product_news' => $product_news,
            'rating'=>$rating,
            'ratingDefaut' => $ratingDefaut,
            'comment'=>$comment
        ]);

        $items = Cart::content();
        return view('user.product.cart')->with([
            'items' => $items,
        ]);

    }

    private function mapRatingDefault(){
        $ratingDefaut = [];
        for($i = 1; $i<=5; $i++){
            $ratingDefaut[$i] = [
                "count_number" => 0,
                "total" => 0,
                "rating" => 0
            ];
            // dd($ratingDefaut);
        }
        return $ratingDefaut;
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
            return redirect()->route('login');
        }
    }

    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
          $feeship = Transport::where('transport_matp',$data['matp'])->where('transport_maqh',$data['maqh'])->where('transport_xaid',$data['xaid'])->get();
          if($feeship){
            $count_feeship = $feeship->count();
            if($count_feeship>0){
             foreach($feeship as $key => $fee){
              Session::put('fee',$fee->fee_ship);
              Session::save();
            }
          }else{ 
            Session::put('fee',25000);
            Session::save();
          }
        }
      
      }
      }
    public function select_delivery(Request $request){
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
        // echo 'done';
        
        return 'done';
    }

    public function staticRatingProduct($id, $number){
        $product = Product::find($id);
        $product->pro_review_total++;
        $product->pro_review_star += $number;
        product->save();
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
        // echo 'done';
        return 'done';
    }

    public function send_mail(){
        //send mail
               $to_name = "Cosmetic Shop";
               $to_email = "nthnga0703@gmail.com";//send to this email
              
            
               $data = array("name"=>"Cosmetic Shop","body"=>'Cảm ơn quý khách hàng đã tin tưởng và mua sản phẩm tại Cosmetic Shop'); //body of mail.blade.php
               
               Mail::send('mail.sendMail',$data,function($message) use ($to_name,$to_email){

                   $message->to($to_email)->subject('Gửi mail cảm ơn khách hàng');//send this mail with subject
                   $message->from($to_email,$to_name);//send from this mail
               });
               // return redirect('/')->with('message','');
               //--send mail
   }
}
