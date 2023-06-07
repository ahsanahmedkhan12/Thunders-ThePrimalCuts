<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        $ordertotal = Order::where('user_id',Auth::user()->id)->count();
        $completetotal = Order::where('user_id',Auth::user()->id)->where('payment_status',"paid")->count();
        $pendingtotal = Order::where('user_id',Auth::user()->id)->where('payment_status',"unpaid")->count();
        $sumtotal = Order::where('user_id',Auth::user()->id)->sum("total_payable");
        
        return view('front.pages.dashboard')->with(compact('branch','ordertotal','completetotal','pendingtotal','sumtotal'));
    }
    public function orderhistory(Request $request)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('front.pages.order-history')->with(compact('branch'));
    }
     public function changepassword(Request $request)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('front.pages.change-password')->with(compact('branch'));
    }
     public function personaldetail(Request $request)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('front.pages.personal-detail')->with(compact('branch'));
    }
}
