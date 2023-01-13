<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAccountController extends Controller
{
    // show pass change page
    public function showPassChangePage()
    {
        return view('admin.account.passChange');
    }


    // change pass
    public function changePass(Request $request)
    {
        Validator::make($request->all(), [
            'currentPass' => 'required|min:8|max:10',
            'newPass' => 'required|min:8|max:10',
            'confirmNewPass' => 'required|min:8|max:10|same:newPass',
        ], [])->validate();

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
            return redirect()->route('adminAccount#passChange')->with(['wrongOldPass' => 'Wrong Password! Retype your old password again.']);
        }
    }


    // show account detail page
    public function showDetailPage()
    {
        return view('admin.account.accountDetail');
    }


    // show account edit page
    public function showEditPage()
    {
        return view('admin.account.accountEdit');
    }


    // edit account
    public function editAccount(Request $request)
    {
        $this->checkValidationForAccountEdit($request);
        $newAccountData = $this->getAdminAccountData($request);
        User::where('id', Auth::user()->id)->update($newAccountData);
        return redirect()->route('adminAccount#detail')->with(['updateMsg' => 'Updating account information success.']);
    }


    // show profile photo edit page
    public function showEditProfilePic()
    {
        return view('admin.account.profilePicEdit');
    }


    //edit profile photo
    public function editProfilePic(Request $request)
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
            return redirect()->route('adminAccount#edit')->with(['photoUpdateMsg' => 'Updating account profile photo success.']);
        }
    }


    // delete profile photo
    public function deleteProfilePic()
    {
        if (Auth::user()->profile_image == null) {
            return back();
        }

        Storage::delete('public/profile_image/' . Auth::user()->profile_image);
        User::where('id', Auth::user()->id)->update(['profile_image' => null,]);
        return redirect()->route('adminAccount#edit')->with(['deletePpMsg' => 'Profile photo deleting success.']);
    }


    //show account list page
    public function showAccountList()
    {
        $adminList = User::when(request()->searchKey, function ($data) {
            $data->where('role', 'admin')->where(function ($data) {
                $data->orwhere('name', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('email', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('address', 'like', '%' . request()->searchKey . '%');
            });
        })->where('role', 'admin')->get();

        $userList = User::when(request()->searchKey, function ($data) {
            $data->where('role', 'user')->where(function ($data) {
                $data->orwhere('name', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('email', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('address', 'like', '%' . request()->searchKey . '%');
            });
        })->where('role', 'user')->get();

        return view('admin/account/accountList', compact('adminList', 'userList'));
    }


    // delete account
    public function deleteAccount()
    {
        if (request()->id == Auth::user()->id) {
            return redirect()->route('admin#showAccountList');
        }

        User::where('id', request()->id)->delete();
        return redirect()->route('admin#showAccountList')->with(['accountDelMsg' => 'Account deleting success.']);
    }

    public function changeAccountRole(Request $request)
    {
        if (request()->id == Auth::user()->id) {
            return redirect()->route('admin#showAccountList');
        }

        User::where('id', $request->id)->update(['role' => $request->role]);
        return redirect()->route('admin#showAccountList')->with(['changeRoleMsg' => 'Account role changing success.']);
    }

    // show customer list page
    public function showCustomerList()
    {
        $customerList = User::when(request()->searchKey, function ($data) {
            $data->where('role', 'user')->where(function ($data) {
                $data->orwhere('name', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('email', 'like', '%' . request()->searchKey . '%')
                    ->orwhere('address', 'like', '%' . request()->searchKey . '%');
            });
        })->where('role', 'user')->get();

        Session::put('prevUrl', request()->fullUrl());

        return view('admin.customer.customerList',compact('customerList'));
    }


    // show customer order list
    public function showCustomerOrderList($id)
    {
        $orderList = Order::select('orders.*','users.name')
        ->where('id',$id)
        ->join('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')->get();

        Session::put('prevUrl', request()->fullUrl());

        return view('admin.customer.orderList',compact('orderList'));
    }


    // get data for admin account edit
    protected function getAdminAccountData($request)
    {
        return $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'ph_no' => $request->phone_number,
        ];
    }

    // validation for admin account edit
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
