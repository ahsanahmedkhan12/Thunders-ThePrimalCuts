<div class="cartmain p-x">
    @if($cart_count > 0)
    <a tooltip="Cart" flow="down" class="js-toggle-cart"> <i class="bi bi-cart-fill" ></i></a>
    <div class="counter2"><span>{{$cart_count}}</span></div>
    @else
    <a tooltip="Cart" flow="down" class="js-toggle-cart"> <i class="bi bi-cart-fill" ></i></a>
    <div class="counter"><span>{{$cart_count}}</span></div>
    @endif
</div>
