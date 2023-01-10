<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    // protected $products;
    // public function __construct(Product $product)
    // {
    //     $this->product = $product;
    // }
    // public function categoryShow(Request $request){
    //     if($request->has('category_id')){
    //         $this->product->where('category_id', $request->input('category_id'));
    //     }
    //     $this->product->get();
    //     return view('home');
    // }
}
