<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Menu;
use App\Models\Branch;
use App\Models\WeekDay;
use App\Models\BranchTime;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\UserExtraDetail;
use Carbon\Carbon;
use Str;
use App\Models\OrderDetail;
use App\Models\AddOnMenu;
use App\Models\OrderDetailAddOn;
class CheckoutData extends Component
{
    public $currentStep = 1;
    public $slottime , $branch , $branchtime , $name , $email , $phone , $address , $instruction , $itemsprice , $payable , $pickupTimes = [],$user_id;
    protected $listeners = ['refreshcheckout' => 'render' , 'refreshcheckoutmount' => 'mount'];
    public function render()
    {
       
        $cartshowdata = Cart::content();
        $dayOfTheWeek = Carbon::now()->isoformat('dddd');
        foreach($cartshowdata as $key => $c) {
            $menu = Menu::where('name' , $c->name)->first();
            $this->branch = Branch::where('id',$menu->branch_id)->first();
            $weekday = WeekDay::where('title',Str::lower($dayOfTheWeek))->first();
            $this->branchtime = BranchTime::where('branch_id',$this->branch->id)->where('weekday_id' , $weekday->id)->first();
  
            $startTime = Carbon::parse($this->branchtime->start_time);
            $endTime = Carbon::parse('10:30 PM');
            $pickupInterval = 45;
            $this->pickupTimes = [];

            $currentTime = $startTime->copy();
            while ($currentTime < $endTime) {
                $pickupTimeStart = $currentTime->format('g:i A');
                $currentTime->addMinutes($pickupInterval);
                $pickupTimeEnd = $currentTime->format('g:i A');
                $this->pickupTimes[] = $pickupTimeStart . ' - ' . $pickupTimeEnd;
            }
            break;
        } 
        if($cartshowdata->count() > 0){
            return view('livewire.checkout-data',compact('cartshowdata'));
        }else{
               return redirect()->to('/');
        }
    }
    public function mount(){
          $user = User::findOrFail(Auth::user()->id);
        $userextradetail = UserExtraDetail::where('user_id',Auth::user()->id)->first();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->user_id = $user->id;
        if(!empty($userextradetail)){
            $this->address = $userextradetail->address ;
        }else{
            $this->address = '';
        }
        $this->itemsprice = Cart::subtotal();
        $this->payable = Cart::subtotal();
        

    }

  


    public function updated($property)
    {
        $this->validateOnly($property, [

        'email'=>['required','email','max:50','min:10','unique:users,email,'.$this->user_id],
        'phone'=>['required','regex:/^(\(\d{3}\))[\s]\d{3}[\s\-]?\d{4}$/','unique:users,phone,'.$this->user_id],
        'address'=>['required','regex:/^[a-zA-Z0-9\s\-\,\.\&\(\#\)]*$/','max:150','min:1'],
        'instruction'=>['required','regex:/^[a-zA-Z0-9\s\-\,\.\&\(\#\)]*$/','max:250','min:1'],

 
        ],[
            'phone.regex'=>'The phone format is invalid (Ex: (111) 111-1111).',
            'email.email'=>'Please enter a valid email address (Ex: johndoe@domain.com).',
            'email.unique'=>'You already have an account with this email address. Please login to continue',  
            'phone.unique'=>'You already have an account with this phone number. Please login to continue',
            'address.regex'=>'Only allow Alphabet , Number and Space -,.()&# ',
            'instruction.regex'=>'Only allow Alphabet , Number and Space -,.()&# ',
        ]);
    }
   public function firstStepSubmit()
    {   
        // Validate the slot time input
        $validateData = $this->validate([
            'slottime' => ['required','regex:/^(0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM) - (0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM)$/','max:20', 'min:17']
        ], [
            'slottime.regex' => 'The slot time format is invalid (Ex: 12:00 am|pm|AM|PM - 12:00 am|pm|AM|PM).',
        ]);

        // Update the current step to proceed to the next step
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        // Validate the user details input
        $this->validate([
            'email' => ['required', 'email', 'max:50', 'min:10', 'unique:users,email,'.$this->user_id],
            'phone' => ['required', 'regex:/^(\(\d{3}\))[\s]\d{3}[\s\-]?\d{4}$/','unique:users,phone,'.$this->user_id],
            'address' => ['required', 'regex:/^[a-zA-Z0-9\s\-\,\.\&\(\#\)]*$/','max:150','min:1'],
            'instruction' => ['required', 'regex:/^[a-zA-Z0-9\s\-\,\.\&\(\#\)]*$/','max:250','min:1'],
        ], [
            'phone.regex' => 'The phone format is invalid (Ex: (111) 111-1111).',
            'email.email' => 'Please enter a valid email address (Ex: johndoe@domain.com).',
            'email.unique' => 'You already have an account with this email address. Please login to continue',
            'phone.unique' => 'You already have an account with this phone number. Please login to continue',
            'address.regex' => 'Only allow Alphabet, Number, Space, -,.()&#',
            'instruction.regex' => 'Only allow Alphabet, Number, Space, -,.()&#',
        ]);

        // Update the user and user extra details
        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,  
        ]);

        $UserExtraDetail = UserExtraDetail::where('user_id', Auth::user()->id)->first();
        if (empty($UserExtraDetail)) {
            $order = UserExtraDetail::create([
                'user_id' => Auth::user()->id,
                'address' => $this->address,  
            ]);
        } else {
            $UserExtraDetail->update([
                'address' => $this->address,  
            ]);
        }

        // Update the current step to proceed to the next step
        $this->currentStep = 3;
    }

    public function back($step)
    {
        // Update the current step to go back to the specified step
        $this->currentStep = $step;    
    }


    public function submitorder(){

        $cart = Cart::content();
        foreach($cart as $key => $c) {
            $menu = Menu::where('name' , $c->name)->first();
            $branchdata = Branch::where('id',$menu->branch_id)->first();
            break;
        }
        $order = Order::create([
            'branch_id' => $branchdata->id ,
            'user_id' => Auth::user()->id,
            'session_id' =>  "empty",
            'payment_status' => "unpaid",
            'order_status' => "delivery",
            'delivery_status' => "delivery",
            'subtotal'  => floatval(str_replace(',', '', Cart::subtotal())),
            'discount'  => "0%",
            'total_payable'  => floatval(str_replace(',', '', Cart::subtotal())),
            'instruction'=> $this->instruction,
            'pickup_time'=> $this->slottime, 
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
   Cart::destroy();

        return redirect()->to('/user/order-history')->with('message', "Your order has been successfully booked.");
    }

       
}
