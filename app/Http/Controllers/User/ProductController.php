<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    public function index(Request $request){
        $min_price = Product::min('sale_price');
        $max_price = Product::max('sale_price');
        $trademarks = Trademark::all();
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
            $products = Product::whereBetween('sale_price', [$min, $max])->orderBy('sale_price', 'ASC')->paginate(16);
        } else{
            $products = Product::orderBy('created_at', 'desc')->paginate(16);
        }
        return view('user.product.all',[
            'min_price' => $min_price,
            'max_price' => $max_price,
            'products' => $products,
            'trademarks' => $trademarks,
        ]);
    }
}
