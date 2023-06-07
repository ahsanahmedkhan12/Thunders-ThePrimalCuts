<div>
  <aside class="cart js-cart">
    <div class="cart__header">
      <h1 class="cart__title">Shopping cart <sub style="color: #858585;">({{$cartshowdata->count()}} Items)</sub></h1>
      <p class="cart__text">
        <a class="button button--light js-toggle-cart" href="#" title="Close cart">
          <i class="bi bi-x-circle"></i>
        </a>
      </p>
    </div>
    <div class="cart__products js-cart-products">
      <div class="cart__product js-cart-product-template">
        <div class="loading" wire:loading>
            <div class="load">
                <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
            </div>
        </div>
        @forelse($cartshowdata as $index => $cartdata)
        <div class="js-cart-product">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="deleteiconcart" wire:click="deletetocart('{{$cartdata->rowId}}','{{$cartdata->id}}')"><i class="bi bi-x-circle-fill"></i></div>
                  <h1>{{ Str::limit($cartdata->name, 50) }}</h1>
                </div>
                <div class="d-flex justify-content-between">    
                    <div class="d-flex items-center justify-center border border-gray-300 px-1 py-1" style="border-radius: 50px;">
                        <div class=" bg-yellow-500 mr-1 rounded-full h-6 w-6 d-flex items-center justify-center cursor-pointer" wire:click="decrement('{{$cartdata->rowId}}','{{$cartdata->id}}')"><i class="bi bi-dash-lg" style="color: #000;"></i></div>
                        <div class="px-2 d-flex justify-center items-center w-6" wire:model="quantity.{{$cartdata->id}}" >{{$cartdata->qty}}</div>
                        <div class="bg-yellow-500 rounded-full h-6 w-6 d-flex items-center justify-center  ml-1 cursor-pointer" wire:click="increment('{{$cartdata->rowId}}','{{$cartdata->id}}')" ><i class="bi bi-plus-lg" style="color: #000;"></i></div>
                    </div>
                </div>
            </div>
            @if($cartdata->options->count() > 0)<div style="color: #858585;font-size: 12px;font-weight: 600;">{{$cartdata->options->count()}} ADD ONS:</div>
            <div style="font-size: 14px;">
                @foreach($cartdata->options as $i => $cart)
                @php
                    $name = App\Models\AddOnMenu::where('id', '=', $cart)->first();
                @endphp
                @if($i > 0 && $cartdata->options->count() > 1) |  @endif {{$name->name}}
                @endforeach
            </div>
            @endif
            <div style="font-size: 16px; color: var(--color-primary); font-weight: 600;">Rs.{{number_format($cartdata->price)}}</div>
        </div>
        @empty
        <div style="text-align: center;">
            <img src="{{asset('assets/img/nodata.svg')}}" width="200px">
            <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">The Cart item is empty.</div>
        </div>
        @endforelse
      </div>
    </div>
    
    <div class="cart__footer d-flex align-items-center justify-content-between">
      @if($cartshowdata->count())<div><h5 style="margin: 0px;">Sub Total :  <strong> Rs.{{Cart::subtotal()}}</strong></h5></div>
      <p class="cart__text">
        <a class="button" href="{{route('checkout')}}" title="Checkout">
          Checkout
        </a>
      </p>
      @endif
    </div>
  </aside>

  <div class="lightbox js-lightbox js-toggle-cart"></div>
</div>
