<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // get product list using ajax
    public function getProductList(Request $request){
        $filterPrice = $request->sortOpt * 1;
        if ($request->sortOpt == 0) {
            $products = Product::get();
        }elseif($filterPrice == '10000'){
            $products = Product::where('price' ,'<=',$filterPrice)->get();
        }else{
            $products = Product::where('price', '<=',$filterPrice)
                        ->where('price','>', $filterPrice - 10000)
                        ->get();
        }

       return response()->json($products, 200);
    }


    // store cart data to db
    public function storeCartData(Request $request){
        // get cart data from req
        $cartData = [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->productAmount,
        ];

        // save cart data to db
        Cart::create($cartData);

        // return success data
        $response = [
            'message' => 'Store cart data to db complete!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    // store order data
    public function storeOrderData(Request $request){

        // get total price from order and store to order list
        $totalPrice = 0;
        foreach ($request->all() as $orderData) {
            $data = OrderList::create($orderData);
            $totalPrice += $data->total_price;
        }

        // delete cart data
        Cart::where('user_id',Auth::user()->id)->delete();

        // get order code and store user order to order table
        $orderCode = $request->all()[0]['order_code'];
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $orderCode,
            'total_price' => $totalPrice + 3000,
        ]);

        // return success data
        $response = [
            'message' => 'Store order data to db complete!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }


    // delete cart item
    public function deleteCartItem(Request $request){

        Cart::where('product_id',$request->productId)
            ->where('cart_id',$request->cartId)
            ->where('user_id',Auth::user()->id)
            ->delete();

        $response = [
            'message' => 'Cart item deleted!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }


    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
        $response = [
            'message' => 'Cart have been cleared!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    // add cart
    public function addCart(Request $request){

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'qty' => 1,
        ]);

        $response = [
            'message' => 'Successfully add a product to cart!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }


    // increase view count
    public function increaseViewCount(Request $request){

        $product = Product::where('product_id',$request->productId)->first();

        Product::where('product_id',$request->productId)->update(['view_count' => $product->view_count + 1]);
    }
}
