<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartCount extends Component
{
    protected $listeners = ['refreshcartcounter' => 'render'];
    public function render()
    {
        $cart_count = Cart::content()->count();
        return view('livewire.cart-count',compact('cart_count'));
    }
}

