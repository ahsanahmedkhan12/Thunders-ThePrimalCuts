<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetailAddOn;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\AddOnMenu;
use Mail;
use PDF;
use Stripe\Customer ;
class IndexController extends Controller
{
    public function index(Request $request)
    {

        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        $category = Category::with('branch')->groupBy('name')->where('status', "active")->orderBy('created_at','asc')->get();
        return view('front.pages.index')->with(compact('branch','category'));
    }

    public function branch(Request $request)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        return view('front.pages.branch')->with(compact('branch'));
    }

    public function branchdetail(Request $request , $slug)
    {
        $branch = Branch::where('status',"active")->orderBy('created_at' , 'asc')->get();
        $branchdata = Branch::where('slug',$slug)->where('status',"active")->first();
        if(!empty($branchdata)){
            $category = Category::where('status',"active")->where('branch_id',$branchdata->id)->orderBy('created_at' , 'asc')->get();
   
            return view('front.pages.branch-detail')->with(compact('category','branch','branchdata'));
        }else{
            abort('404');
        }
    }
    public function checkout(Request $request)
    {
        if(Gate::allows('isUser')){

 
            if(Cart::count()>=1 ){ 
                return view('front.pages.checkout');
            }elseif(Cart::count()==0){
                return redirect('/user/dashboard');
            }else{
                return redirect('/');
            }         
        }elseif(Gate::allows('isAllowAdminManager')){
            if(Cart::count()>=0){
                  return redirect('/control-area/dashboard');
            }
        }else{
            return redirect('/login');   
        }
        
    }

    public function checkoutcard(Request $request,$time,$instruction)
    {
        if(Cart::content()->count() > 0){
            
            Stripe::setApiKey('sk_test_51MiltjDfcxP809Rsn3j7TBn3QkulHnC2l4uGGEsqrj8ZUJSdyrEUFKjZjaCcUuflHT3iHutm032R8dWfg1gFVbb800Y0yIgobG');
            $cancel = 'http://127.0.0.1:8000/checkout';
            $cart = Cart::content();
            $order = Order::where('user_id',Auth::user()->id)->count();
            $lineItems = [] ;
            $totalAmount=0;
            $payable=0;
            foreach($cart as $key => $c) {
                $menu = Menu::where('name' , $c->name)->first();
                $branchdata = Branch::where('id',$menu->branch_id)->first();
                break;
            }

            if($order == 0){
              
                foreach ($cart as $item) {
                    $totalAmount += $item->price * $item->qty;
                }
                $payable =  $totalAmount ;
                $lineItems[] = [ 
                    'price_data' => [
                        'currency' => 'pkr',
                        'unit_amount' => $payable* 100 ,
                        'product_data' => [
                           'name' => 'Cart Items Pay',
                        ],
                    ],
                    'quantity' => 1,];

            }else{
              
                foreach ($cart as $key => $value) {
                    if($value->options->count() > 0){
                        $addon = ' '.'('.$value->options->count().')'.'Add-On';
                    }else{
                        $addon = null;
                    }

                    $lineItems[] = [ 
                        'price_data' => [
                            'currency' => 'pkr',
                            'product_data' => [
                                'name' => $value->name . $addon,
                            ],
                            'unit_amount' => $value->price * 100,
                        ],
                        'quantity' => $value->qty,
                    ];
                }
            }
            $current_time = Carbon::now();
            $expiration_time = $current_time->addMinutes(30);
            $session = Session::create([
              'line_items' => [$lineItems],
              'mode' => 'payment',
              'success_url' => route('checkout.success',[],true)."?session_id={CHECKOUT_SESSION_ID}",
              'cancel_url' => route('checkout.cancel',[],true) ,
                'expires_at' =>  $expiration_time->timestamp,
              'payment_method_types'=> ['card'],
            ]);
          

              $discount = "0%" ;
            

            $order = Order::create([
                'branch_id' => $branchdata->id ,
                'user_id' => Auth::user()->id,
                'session_id' =>  $session->id,
                'payment_status' => "unpaid",
                'order_status' => "delivery",
                'delivery_status' => "delivery",
                'subtotal'  => floatval(str_replace(',', '', Cart::subtotal()))
               ,
                'discount'  => $discount,
                'total_payable'  => floatval(str_replace(',', '', Cart::subtotal())),
                'instruction'=> $instruction,
                'pickup_time'=> $time, 
            ]);

             foreach ($cart as $key => $v) {
                $menudetail = Menu::where('name' , $v->name)->first();
                $subtotal = $menudetail->price * $v->qty;
                $orderdetail = OrderDetail::create([
                    'order_id' => $order->id ,
                    'menu_id' =>$menudetail->id,
                    'quantity' =>  $v->qty,
                    'subtotal' => $subtotal,
                ]);
                    $orderdetailid = OrderDetail::where('id',$orderdetail->id)->first();
                    foreach ($v->options as $key => $addon) {
                        $addonmenudetail = AddOnMenu::where('id' , $addon)->first();
                        $addonsubtotal = $addonmenudetail->price * $v->qty;
                        $orderdetail = OrderDetailAddOn::create([
                            'order_detail_id' => $orderdetailid->id,
                            'add_on_menu_id' =>$addonmenudetail->id,
                            'quantity' =>  $v->qty,
                            'subtotal' => $addonsubtotal,
                        ]);
                    }
                
             }

            return redirect()->away($session->url);

        }else{
            return redirect()->to('/');
        }
      
    }

    public function checkoutsuccess(Request $request)
    {  
        Stripe::setApiKey('sk_test_51MiltjDfcxP809Rsn3j7TBn3QkulHnC2l4uGGEsqrj8ZUJSdyrEUFKjZjaCcUuflHT3iHutm032R8dWfg1gFVbb800Y0yIgobG');
        $session_id = $request->get('session_id');
        try {
          $session = Session::retrieve($session_id);
           // dd( $session);
          if(!$session){
              abort(404);
          }
          
          $orderdata = Order::where('session_id' , $session_id)->where('payment_status',"unpaid")->first();
         
          if(!$orderdata){
            abort(404);
          }
        
           $orderdata->payment_status = "paid";
           $orderdata->save();
           $orderdataget = Order::with(['user','branch'])->where('session_id' , $session_id)->where('payment_status',"paid")->first();
           // $user =  User::where('id', $orderdataget->user_id)->first();
           // $data["email"] =   $user->email;
           // $data["title"] = "Order Confirm Invoice";
           // $data["body"] = "Your Order Successfully Book. Your Order Invoice Attach.";
           // $data["orderdataget"]= $orderdataget;
           //  $pdf = PDF::loadView('invoicemail', $data);
           //  Mail::send('invoicemail', $data, function ($message) use ($data,$orderdataget, $pdf) {
           //      $message->to($data["email"], $data["email"])
           //          ->subject($data["title"])
           //          ->attachData($pdf->output(), $orderdataget->order_code.".pdf");
           //  });
            Cart::destroy();

          return redirect()->to('/user/order-history')->with('message', "Your order has been successfully booked.");
        } catch (Error $e) {
            abort(404);
        }
    }

    public function checkoutcancel()
    {
        // code...
    }
}