<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Menu;
use App\Models\AddOnMenu;
use Gloudemans\Shoppingcart\Facades\Cart;
class ShowMenu extends Component
{
    public $category;
    public $checkboxValue = [];
    public $totalValue = 0 , $Value;
    public $quantity = 1;
    protected $listeners = ['refreshmenu' => 'render'];
    public function increaseQuantity()
    {
        $this->quantity++;

    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;

        }
    }

    public function updateTotalValue($Valueid, $index, $totalprice)
    {
        // Retrieve the addon menu value
        $this->Value = AddOnMenu::where('id', $Valueid)->first();

        // Check if the checkbox value is selected
        if ($this->checkboxValue[$index]) {
            if (!empty($this->Value)) {
                // Add the value price to the total value
                if ($this->totalValue == 0) {
                    $this->totalValue += $this->Value->price + $totalprice;
                } else {
                    $this->totalValue += $this->Value->price;
                }
            } else {
                // Reset the total value and checkbox value if the value is empty
                $this->totalValue = 0;
                $this->checkboxValue = [];
                return session()->flash('error', 'Refresh the page internet is slow.');
            }
        } else {
            if (!empty($this->Value)) {
                // Subtract the value price from the total value
                if ($this->totalValue == 0) {
                    $this->totalValue -= $this->Value->price + $totalprice;
                } else {
                    $this->totalValue -= $this->Value->price;
                }
            } else {
                // Reset the total value and checkbox value if the value is empty
                $this->checkboxValue = [];
                $this->totalValue = 0;
                return session()->flash('error', 'Refresh the page internet is slow.');
            }
        }
    }
 
    public function render()
    {
        $cart = Cart::content();
        return view('livewire.show-menu', compact('cart'));

    }
    public function mount($slug){
        $branchdata = Branch::where('slug',$slug)->where('status',"active")->first();
        if(!empty($branchdata)){
            $this->category = Category::with('menu')->where('status',"active")->where('branch_id',$branchdata->id)->orderBy('created_at' , 'asc')->get();
        }else{
            abort('404');
        }
    }
    public function addtocart($menu_id){
 
        $menu = Menu::findOrFail($menu_id);
        $sum =  AddOnMenu::whereIn('id',$this->checkboxValue)->sum('price');
        $price = $sum + $menu->price;
        Cart::add(['id' =>  $menu->id, 'name' =>  $menu->name, 'qty' =>  $this->quantity, 'price' => $price , 'weight' => 0, 'options' => $this->checkboxValue]);
       $this->checkboxValue = [];
       $this->quantity = 1;
       $this->totalValue = 0;
       $this->emit('refreshcartcounter');
       $this->emit('refreshcartshow');
       $this->emit('closemodal');
       $this->emit('cartOpen');
       
    }
    public function deletetocart($rowId , $menu_id){
       $menu = Menu::findOrFail($menu_id);
       Cart::remove($rowId);   
        $this->emit('refreshcartshow');      
       $this->emit('refreshcartcounter');
       $this->emit('cartOpen');

    }
}
