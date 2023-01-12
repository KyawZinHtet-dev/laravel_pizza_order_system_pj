<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCartListPage(){
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $cartDatas = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image')
                    ->join('products','carts.product_id','products.product_id')
                    ->where('user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach ($cartDatas as $cartData) {
            $totalPrice += $cartData->product_price * $cartData->qty;
        }

        $deliveryFeed = 3000;

        return view('user.cart.cartList',compact('categories','cartList','cartDatas','totalPrice','deliveryFeed','orderCount'));
    }
}
