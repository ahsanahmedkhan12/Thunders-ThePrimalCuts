<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Menu;
class CartShow extends Component
{
    protected $listeners = ['refreshcartshow' => 'render','refreshmount' => 'mount'];
   
    public array $quantity =[];
    public $cart;
    
    public function increment($rowId,$menu_id)
    {
       $menu = Menu::findOrFail($menu_id);
       $cart=Cart::get($rowId);
       Cart::update($rowId, $cart->qty+1);
       $this->emit('refreshcartcounter');
       $this->emit('refreshcartshow');
       $this->emit('refreshmenu');
       $this->emit('refreshcheckout');
       $this->emit('refreshcheckoutmount');
    }
    
    public function decrement($rowId,$menu_id)
    {
       $menu = Menu::findOrFail($menu_id);
       $cart=Cart::get($rowId);
       Cart::update($rowId, $cart->qty-1);
       $this->emit('refreshcartcounter');
       $this->emit('refreshcartshow');
       $this->emit('refreshmenu');
       $this->emit('refreshcheckout');
       $this->emit('refreshcheckoutmount');
    }
    
    public function render()
    {   
        $cartshowdata = Cart::content();
        foreach($cartshowdata as $c) {
            $this->quantity[$c->id] =  $c->qty;   
        }
        return view('livewire.cart-show',compact('cartshowdata')); 
    }

    public function deletetocart($rowId , $menu_id){
        $menu = Menu::findOrFail($menu_id);
        Cart::remove($rowId);
        $this->quantity[$menu->id] = 1;
        $this->emit('refreshcartcounter');
        $this->emit('refreshcartshow');
        $this->emit('refreshmenu');
        $this->emit('refreshcheckout');
        $this->emit('refreshcheckoutmount');
    }
}
