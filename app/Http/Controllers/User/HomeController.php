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
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

        if($request->has('category_id'))
        {
            $products = Product::where('category_id', $request->input('category_id'));
        }

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

    public function showProduct($id){

        // dd($id);die();


        $products = Product::where('category_id', $id)->get();
        $trademark_name = Trademark::orderBy('name', 'DESC')->get();
        $category_name = Category::orderBy('created_at', 'DESC')->get();
        $trademarks = Trademark::orderBy('name', 'DESC')->get();

        // dd($products);

        return view('user.product.all')->with([
            'products' => $products,
            'trademarks' => $trademarks,
            'trademark_name' => $trademark_name
        ]);
    }

    public function search(Request $request){
        session()->regenerate();
        $keyword = Session::get('keywords');
        if($request->has('keywords')){
            Session::put('keywords',$request->keywords);
        }

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
        $size = 10;
        if($request->has('category_id')){
            $products = Product::where('category_id', $request->input('category_id'));
        }

        
        if (isset($_GET['sort_by'])){
            Log::info('sort by');
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan'){
                $products = Product::orderBy('sale_price', 'DESC');
            } elseif ($sort_by == 'tang_dan'){
                $products = Product::orderBy('sale_price', 'ASC');
            } elseif ($sort_by == 'kytu_az'){
                $products = Product::orderBy('name', 'ASC');
            } elseif ($sort_by == 'kytu_za'){
                $products = Product::orderBy('name', 'DESC');
            }
        }elseif (isset($_GET['amount_start']) && ($_GET['amount_end'])){
            Log::info('amount');
            $min = $_GET['amount_start'];
            $max = $_GET['amount_end'];
            $products = Product::whereBetween('sale_price', [$min, $max])->orderBy('sale_price', 'ASC');
        }elseif (isset($_GET['trademark'])){
            // Log::info('trademark');
            $filter_trademark = $_GET['trademark'];
            $trademark_arr = explode(",", $filter_trademark);
            $products = Product::whereIn('trademark_id', $trademark_arr)->orderBy('created_at', 'desc');
            // ->appends(request()->query());

        }elseif (isset($_GET['category'])){
            $filter_category = $_GET['category'];
            $cate_arr = explode(",", $filter_category);
            $products = Product::whereIn('category_id', $cate_arr)->orderBy('created_at', 'desc');
            // ->appends(request()->query());

        }else{
            $products = Product::orderBy('created_at', 'desc');
        }

        $trademark_name = Trademark::orderBy('name', 'DESC')->get();
        $category_name = Category::orderBy('created_at', 'DESC')->get();
        $trademarks = Trademark::orderBy('name', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();


        return view('user.product.all')->with([
           'products' => $products->paginate(9),
           'amount_start' => $min,
           'amount_end' => $max,
           'trademarks' => $trademarks,
           'trademark_name' => $trademark_name,
           'categories' => $categories,
           'category_name' => $category_name,
        ]);
    }

    public function coupon_user(){
         
        
        $now = Carbon::now();
        // $coupons = Coupon::where('coupon_times', '=', 500)->get();

        // dd($coupons);
      
        $couponShow = Coupon::where('start_time', '<=', $now)
                            ->where('end_time', '>=', $now)
                            ->get();
        // dd($couponShow);

        $coupons = Coupon::paginate(7);
        return view('user.product.coupon')->with([
            'coupons' => $coupons,
            'couponShow' => $couponShow
        ]);
    }

    public function show($id){
        $product = Product::where('id',$id)->with(['category','images','trademark'])->first();
        
        $product_news = Product::orderBy('created_at', 'DESC')->limit(4)->get();
        $cate_product = Category::orderBy('id', 'DESC')->get();
        $trademark_product = Trademark::orderBy('id', 'DESC')->get();
        $totalRatingCount = Rating::where('product_id', $id)->count();

        //saotrungbinh
        $avgRating = $this->getAvgRating($id);
    
        //dem sao
        $ratings = $this->countRatings($id);
        $currentRating = $this->getCurrentRating($id);
        // dump($ratings);

        $comment = Comment::with('user')->where('product_id',$id)->where('status', 1)->get();

        return view('user.product.detail')->with([
            'product' => $product,
            'product_news' => $product_news,
            'avgRating' => $avgRating,
            'ratings' => $ratings,
            'totalRatingCount' => $totalRatingCount,
            'currentRating' => $currentRating,
            'comment'=>$comment
        ]);

        $items = Cart::content();
        return view('user.product.cart')->with([
            'items' => $items,
        ]);

    }

    private function getCurrentRating($productId) {
        $user = Auth::user();
        if ($user) {
            $model = Rating::where('user_id', Auth::user()->id)->where('product_id', $productId)
                            ->get('rating')->first();
            return $model ? $model->rating : 0;
        }

        return 0;
    }    

    //dem luot danh gia, tong so nguoi danh gia
    private function countRatings($id)
    {
        $ratingCounts = [];
        $totalRatingCount = Rating::where('product_id', $id)->count();

        for($star = 0; $star < 5; $star++){
            $count = Rating::where('rating', $star+1)->where('product_id', $id)->count();
            
            $ratingCounts[$star] = [
              'count' => $count,
              'percentage' => $totalRatingCount===0 ? 0 : ($count/$totalRatingCount) * 100
            ];
        }
        return $ratingCounts;
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

    public function staticRatingProduct($id, $number){
        $product = Product::find($id);
        $product->pro_review_total++;
        $product->pro_review_star += $number;
        product->save();
    }

    public function comment_product(Request $request){
        $data = $request->all();
        $isUserRated = Rating::where('product_id', $data['product_id'])
                             ->where('user_id', Auth::user()->id)->count() > 0;
        if ($isUserRated) {
            Rating::where('product_id', $data['product_id'])
                 ->where('user_id', $data['user_id'])
                 ->first()
                 ->update([
                    'rating' => $data['current_rating']
                 ]);
            if (strlen($data['content_comment']) > 0) {
                Comment::where('user_id', $data['user_id'])
                       ->where('product_id', $data['product_id'])
                       ->update([
                        'content' => $data['content_comment']
                       ]);
            }
        } else {
            $this->insertRating($data);
            $comment = new Comment();
            $comment->user_id = $data['user_id'];
            $comment->product_id = $data['product_id'];
            $comment->name = Auth::user()->name;
            $comment->email = Auth::user()->email;
            $comment->content = $data['content_comment'];
            $comment->save();
        }

        return 'done';
    }

    private function insertRating($data) {
        $rating = new Rating();
        $rating->user_id = Auth::guard('web')->user()->id;
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['current_rating'];
        $rating->save();
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

   public function getAvgRating($id){

        $rating = Rating::where('product_id',$id)->avg('rating');
        $rating = round($rating);

       return $rating;
    //    dd($productId);
   }
}
