<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function showContactPage(){
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();

        return view('user.contact.contact',compact('orderCount','categories','cartList'));
    }

    public function sendMessage(Request $request){
        $this->validationForContact($request);

        Contact::create([
            'name' => $request->customerName,
            'email' => $request->customerEmail,
            'message' => $request->customerMessage,
        ]);

        return redirect()->route('contact#showContactPage')->with(['successMsg' => 'Sending message to admin team success!']);
    }

    private function validationForContact($request){
        Validator::make($request->all(), [
            'customerName' => 'required',
            'customerEmail' => 'required',
            'customerMessage' => 'required',
        ], [])->validate();
    }
}
