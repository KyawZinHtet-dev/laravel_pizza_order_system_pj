<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // user panel
    // show order history page
    public function showOrderHistoryPage(){
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)
                    ->select('orders.*','users.name as user_name')
                    ->join('users','orders.user_id','users.id')
                    ->orderBy('created_at','desc')
                    ->paginate(5);
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $orders->appends(request()->query());

        return view('user.order.orderHistory',compact('orders','categories','cartList','orderCount'));

    }

    // show ordered items page
    public function showOrderedItemsPage(Request $request){
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $orderedItems = OrderList::where('order_code',$request->orderCode)
                        ->select('order_lists.*','products.name as product_name','products.price as product_price','products.image')
                        ->join('products','order_lists.product_id','products.product_id')
                        ->get();
        $totalPrice = 0;
        foreach ($orderedItems as $orderedItem) {
            $totalPrice += $orderedItem->total_price;
        }

        $deliveryFeed = 3000;

        return view('user.order.orderedItems',compact('orderedItems','categories','cartList','orderCount','totalPrice','deliveryFeed'));
    }



    // admin panel
    // show order list page
    public function showOrderListPage(){
        $orderList = Order::select('orders.*','users.name')
                    ->join('users','orders.user_id','users.id')
                    ->orderBy('created_at','desc')->get();

        return view('admin.order.orderList',compact('orderList'));
    }


    // return order list data by sorting using ajax
    public function sortOrderList(Request $request){

        $sortingOrderData = Order::select('orders.*','users.name')
                            ->join('users','orders.user_id','users.id')
                            ->orderBy('created_at','desc');

        if ($request->sortOptValue == null) {
            $sortingOrderData = $sortingOrderData->get();
        }else{
            $sortingOrderData = $sortingOrderData->where('status', $request->sortOptValue)->get();
        }

        return response()->json($sortingOrderData,200);
    }

    // change order status using ajax
    public function changeOrderStatus(Request $request){

        Order::where('order_id', $request->orderId)->update(['status' => $request->orderStatus]);

        $response = [
            'message' => 'Order status have been changed!',
            'status' => 'success',
        ];
        return response()->json($response,200);
    }


    // show ordering items page
    public function showOrderingItemsPage($orderCode){

        $orderingItems = OrderList::where('order_code',$orderCode)
        ->select('order_lists.*','products.name as product_name','products.price as product_price','products.image')
        ->join('products','order_lists.product_id','products.product_id')
        ->get();

        $orderInfo = Order::where('order_code',$orderCode)
                    ->select('orders.*','users.name')
                    ->join('users','orders.user_id','users.id')
                    ->first();

        return view('admin.order.orderedItems',compact('orderingItems','orderInfo'));
    }
}
