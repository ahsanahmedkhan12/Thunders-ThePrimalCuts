<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Menu;
use App\Models\Branch;
use App\Models\WeekDay;
use App\Models\BranchTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserExtraDetail;
use Carbon\Carbon;
use Str;
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
            if(number_format($this->payable , 2) < "100.00" ){
               $pickupInterval = 10;
            }else{
                $pickupInterval = 20;
            }
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
        $this->itemsprice  = Cart::subtotal();
        $number = Cart::subtotal();
        $percent = 15;
        $this->payable = $number - ($number * $percent / 100);
        

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
       
        $validateData = $this->validate([
            'slottime'=>['required','regex:/^(0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM) - (0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM)$/','max:20', 'min:17']
        ],[
           'slottime.regex'=>'The slot time format is invalid (Ex: 12:00 am|pm|AM|PM - 12:00 am|pm|AM|PM).', 

        ]);

        $this->currentStep = 2;
    }
     public function secondStepSubmit()
    {
        $this->validate([
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

        $user = User::find(Auth::user()->id);
        $user->update([
            'name'   =>  $this->name,
            'email'      =>  $this->email,
            'phone' => $this->phone,  
        ]);
        $UserExtraDetail = UserExtraDetail::where('user_id', Auth::user()->id)->first();
            if(empty($UserExtraDetail)){
                $order =  UserExtraDetail::create([
                    'user_id' => Auth::user()->id,
                    'address' => $this->address,  
                ]);
            }else{
                $UserExtraDetail->update([
                    'address' => $this->address,  
                ]);
            }
  
        $this->currentStep = 3;
    }
   

    public function back($step)
    {
        $this->currentStep = $step;    
    }
   
}
