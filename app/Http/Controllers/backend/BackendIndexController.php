<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use DB; 
use Validator; 
class BackendIndexController extends Controller
{
    public function index(Request $request){
        $ordertotal = Order::count();
        $completetotal = Order::where('payment_status',"paid")->count();
        $pendingtotal = Order::where('payment_status',"unpaid")->count();
        $sumtotal = Order::sum("total_payable");
       return view('back.pages.dashboard')->with(compact('ordertotal','completetotal','pendingtotal','sumtotal'));   
    }

     public function contactdetail(Request $request){
        if($request->ajax())
        {
            $data = Contact::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="category_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('cname', function($data) {
                      $name = Str::title($data->name);
                      return  $name ;

                    }) 
                     ->addColumn('cemail', function($data) {
                      $email = Str::title($data->email);
                      return  $email ;

                    }) 
                      ->addColumn('cphone', function($data) {
                      $phone = $data->phone;
                      return  $phone ;

                    }) 
                     ->addColumn('csubject', function($data) {
                      $subject =  Str::title($data->subject);
                      return  $subject ;

                    }) 
                      ->addColumn('cmessage', function($data) {
                      $message =  Str::title($data->message);
                      return  $message ;

                    }) 
                
                   ->addColumn('ccreated_at', function($data) {
                      $a = Carbon::parse($data->created_at)->format('d/m/Y  h:i:s A');
                      return $a;                   
                    })
                    ->rawColumns(['checkbox','cname','cemail','cphone','csubject','cmessage','ccreated_at'])
                    ->make(true);
        }
        return view('back.pages.user-contact');
     
    }

    public function orderhistory(Request $request)
    {
        if($request->ajax())
        {
            $data = Order::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="category_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
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
                              $upaymentstatus = '<input type="text"  class=" rounded-0 form-control" name="payment_status" id="payment_status-'.$data->id.'" value="'.Str::ucfirst($data->payment_status).'" >';
                    
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
                     
                     $button = '&nbsp;<a href="'.url('/control-area/order-history-full-detail/').'/'.$data->id.'" class="m-5-r show-booking btn btn-success btn-sm" id="'.$data->id.'"><i class="fa fa-eye"></i></a>';
                       if(Str::lower($data->payment_status) != "paid"){
                     $button .= '&nbsp;<button class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                      }
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','ubranch','uusername','uordercode','upaymentstatus','uorderstatus','usubtotal','udiscount','utotalpayable','udeliverytime','ucreated_at','action'])
                    ->make(true);
        }
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('back.pages.order-history')->with(compact('branch'));

    }
    public function orderhistoryfulldetail(Request $request , $id)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        $order = Order::where('id',$id)->first();
        return view('back.pages.order-full-detail')->with(compact('branch','order'));
    }
    public function multipledelete(Request $request){
        
        $order_id = $request->input('id');
        $orders = Order::whereIn('id', $order_id);   
        if($orders->delete())
         return response()->json(['success' => 'Order Seleted Data Deleted Successfully']);   
    }
    public function alldelete(){
          
        $ordersdel = DB::table('orders')->delete(); 
        if($ordersdel == true ){
            return response()->json(['success' => 'Order Seleted Data Deleted Successfully']); 
        }else {
          return response()->json(['error' => 'Order  table is empty']); 
         }
    }
    public function edit(Request $request,$id)
    {
         

        $order= Order::find($id);
 
        if($order != null){
          
            $error = $validator = Validator::make($request->only(['payment_status']),[
            'payment_status'=> ['required','regex:/^[a-zA-Z]*$/','max:6','min:4'],
           
            ]);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if($request->isMethod('post')){
                $data=$request->only(['payment_status']);
                 if(Str::lower($data['payment_status']) != "paid"){
                   return response()->json(['dberror' => 'Payment status only allow paid']);
                 }

                $order->payment_status = $data['payment_status'];
                $order->save();
                return response()->json(['success' => 'Order is  Update Successfully']);
            }
        }
        }else{
            return response()->json(['dberror' => 'Please refresh the page']);  
        }
       
    }

}
