<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Branch;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
class UserHistoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Order::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)

                    ->addColumn('ubranch', function($data) {
                      $bname = Str::title($data->branch->name);
                      return  $bname ;
                    }) 
                    ->addColumn('uordercode', function($data) {
                      $ordercode = Str::title($data->order_code);
                      return  $ordercode ;
                    }) 
                    ->addColumn('upaymentstatus', function($data) {
                        if(Str::lower($data->payment_status) == "paid"){
                            $upaymentstatus = '<p class="text-success font-weight-bold ">'. Str::ucfirst($data->payment_status).'</p>';
                            return  $upaymentstatus;
                        }else{
                             $upaymentstatus = '<p class="text-danger font-weight-bold">'. Str::ucfirst($data->payment_status).'</p>';
                              return  $upaymentstatus;
                        }
                      
                    }) 

                    ->addColumn('uorderstatus', function($data) {
                      $uorderstatus = Str::title($data->order_status);
                      return  $uorderstatus ;
                    })
                    ->addColumn('usubtotal', function($data) {
                      $usubtotal = $data->subtotal;
                      return  $usubtotal ;
                    }) 
                    ->addColumn('udiscount', function($data) {
                      $udiscount = $data->discount;
                      return  $udiscount ;
                    }) 
                    ->addColumn('utotalpayable', function($data) {
                      $utotalpayable = $data->total_payable;
                      return  $utotalpayable ;
                    }) 

                    ->addColumn('udeliverytime', function($data) {
                      $udeliverytime = $data->pickup_time;
                      return  $udeliverytime ;
                    }) 

                   ->addColumn('ucreated_at', function($data) {
                      $a = Carbon::parse($data->created_at)->format('d/m/Y  h:i:s A');
                      return $a;                   
                    })
                                          
                    ->addColumn('action', function($data){
                         $button = '&nbsp;<a href="'.url('/user/order-history-full-detail/').'/'.$data->id.'" class="m-5-r show-booking btn btn-success btn-sm" id="'.$data->id.'">View</a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['ubranch','uusername','uordercode','upaymentstatus','uorderstatus','usubtotal','udiscount','utotalpayable','udeliverytime','ucreated_at','action'])
                    ->make(true);
        }
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('front.pages.order-history')->with(compact('branch'));

    }
    public function orderhistoryfulldetail(Request $request , $id)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        $order = Order::where('id',$id)->first();
        return view('front.pages.order-full-detail')->with(compact('branch','order'));
    }

}
