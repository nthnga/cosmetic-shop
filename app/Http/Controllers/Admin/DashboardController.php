<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController
{
    public function index(){
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::where('status','5')->count(); 
        return view('admin.dashboard', compact('categories','products','orders'));
    }
}
