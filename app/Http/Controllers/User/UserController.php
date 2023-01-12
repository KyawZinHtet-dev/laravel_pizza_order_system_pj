<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // show user home page
    public function showUserHomePage()
    {
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $products = Product::get();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.user_home', compact('products', 'categories','cartList','orderCount'));
    }


    // show account detail page
    public function showAccountDetailPage()
    {
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.account_detail_page', compact('categories','cartList','orderCount'));
    }


    // show account edit page
    public function showAccountEditPage()
    {
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.account_edit_page', compact('categories','cartList','orderCount'));
    }


    // edit account
    public function editAccount(Request $request)
    {
        $this->checkValidationForAccountEdit($request);
        $newAccountData = $this->getAdminAccountData($request);
        User::where('id', Auth::user()->id)->update($newAccountData);
        return redirect()->route('user#showAccountDetailPage');
    }


    // show profile pic change page
    public function showProfilePicChangePage()
    {
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.profilePic_change_page', compact('categories','cartList','orderCount'));
    }


    // profile pic change
    public function changeProfilePic(Request $request)
    {
        // check validation
        Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png',
        ], [])->validate();


        if ($request->hasFile('image')) {
            // delete old image
            if (Auth::user()->profile_image != null) {
                Storage::delete('public/profile_image/' . Auth::user()->profile_image);
            }

            // save image to /public and name to database
            $imgName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/profile_image', $imgName);
            User::where('id', Auth::user()->id)->update(['profile_image' => $imgName]);

            // return to profile edit page
            return redirect()->route('user#showAccountEditPage');
        }
    }


    // delete profile pic
    public function deleteProfilePic()
    {
        if (Auth::user()->profile_image == null) {
            return back();
        }

        Storage::delete('public/profile_image/' . Auth::user()->profile_image);
        User::where('id', Auth::user()->id)->update(['profile_image' => null,]);
        return redirect()->route('user#showAccountEditPage');
    }


    // show password change page
    public function showPassChangePage()
    {
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.account.pass_change_page', compact('categories','cartList','orderCount'));
    }


    // change password
    public function changePass(Request $request)
    {
        // validation for password
        Validator::make($request->all(), [
            'currentPass' => 'required|min:8|max:10',
            'newPass' => 'required|min:8|max:10',
            'confirmNewPass' => 'required|min:8|max:10|same:newPass',
        ], [])->validate();

        // check old pass and new pass same or not and update user new pass with hash
        $currentPass = $request->currentPass;
        if (Hash::check($currentPass, Auth::user()->password)) {
            $newPass = Hash::make($request->newPass);
            $loggedInUserId = Auth::user()->id;
            User::where('id', $loggedInUserId)->update([
                'password' => $newPass,
            ]);

            Auth::logout();
            return redirect('/loginPage');
        } else {
            return redirect()->route('user#showPassChangePage')->with(['wrongOldPass' => 'Wrong Password! Retype your old password again.']);
        }
    }


    // delete account
    public function deleteAccount()
    {
        User::where('id', Auth::user()->id)->delete();
        Auth::logout();
        return redirect('/loginPage');
    }


    // filter products by category
    public function filterByCategory($category_id){
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $products = Product::where('category_id',$category_id)->get();

        return view('user.user_home', compact('products', 'categories','cartList','orderCount'));
    }


    // show product detail page
    public function showProductDetailPage($product_id){
        $orderCount = Order::where('user_id',Auth::user()->id)->get()->count();
        $categories = Category::get();
        $product = Product::where('product_id',$product_id)->first();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $productList = Product::get();
        return view('user.product_detail_page',compact('product','categories','productList','cartList','orderCount'));
    }


    // get data for account edit
    protected function getAdminAccountData($request)
    {
        return $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'ph_no' => $request->phone_number,
        ];
    }

    // validation for account edit
    protected function checkValidationForAccountEdit($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_number' => 'required',

        ], [])->validate();
    }
}
