<div>
    @forelse($category as $key => $cat)
   
            <h3 id="{{$cat->slug}}">{{Str::title($cat->name)}}</h3>
            <p>{{Str::title($cat->description)}}</p>
            <hr>
            <div class="row gy-4">
              @forelse($cat->menu as $data)
              
              <div class="col-lg-4 col-md-4 col-sm-6 col-12 ourspecialfoodmain">
                <div class="ourspecialfoodimg">
                  <div class="ourspecialfoodimg1">
                    <a href="{{asset($data->imagePath)}}" class="glightbox"><img src="{{ $data->imagePath}}" class="img-fluid" ></a>
                  </div>
                </div>
                <h4>{{ Str::limit($data->name, 25) }}</h4>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-4" style="font-weight: 600;display: flex;align-items: center;font-size: 18px;color: var(--color-primary);">Rs.{{$data->price}}</div>
                 
                    @if ($cart->where('id',$data->id)->count())
                      @php
                      $c =$cart->where('id',$data->id)->first();
                      @endphp
                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 remove">
                      <div  wire:click.prevent="deletetocart('{{$c->rowId}}','{{$data->id}}')" wire:loading.attr="disabled"><a wire:loading.attr="disabled"> Remove <div wire:loading class="spinner-border text-white" role="status" style="width: 20px;height: 20px;"><span class="sr-only"></span></div> </a></div>
                    </div>
                    @else
                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 add">
                      <a href="#" data-toggle="modal" data-target="#{{$data->slug}}">Add</a>
                    </div> 
                    @endif
                
                </div>
              </div> 
              <!-- Button trigger modal -->
              
                <div class="modal fade closemodal" id="{{$data->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="margin: 0px;padding-top: 80px; padding-right: -1px !important;" wire:ignore.self>
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form wire:submit.prevent="addtocart('{{$data->id}}')" method="post">
                      @csrf
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ Str::title($data->name) }}</h5>
                        <button style="background-color: var(--color-primary);color: #fff;border: 1px solid #fff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div style="color: #444;margin-bottom: 20px;"><h5>Add-On</h5></div>
                            @forelse($data->addonmenu as $index => $addondata)
                            <div class="minisunmenuarea d-flex justify-content-between">
                                <div class="d-flex">
                                    <div> <input type="checkbox" class="attribute" value="{{$addondata->id}}" wire:model="checkboxValue.{{$index}}" wire:click="updateTotalValue($event.target.value, {{$index}} , {{$data->price}})"></div>
                                <div style="margin-left: 10px;"><h6><strong>{{$addondata->name}}</strong></h6></div>
                                </div>
                                
                                <div><p class="price">Rs.{{$addondata->price}}</p></div>
                            </div>
                            @empty
                            <div style="text-align: center;">
                                <img src="{{asset('assets/img/nodata.svg')}}" width="150px">
                                <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">The Add-On for this item is empty.</div>
                            </div>
                            @endforelse
                            <hr>
                       <div class="d-flex justify-content-between">    
                            <div style="font-size: 18px;color: #000;display: flex;align-items: center; font-weight: 600;">Quantity : </div>
                            <div class="d-flex items-center justify-center border border-gray-300 px-1 py-1" style="border-radius: 50px;">
                            <div class=" bg-yellow-500 mr-1 rounded-full h-6 w-6 d-flex items-center justify-center cursor-pointer" wire:click="decreaseQuantity"><i class="bi bi-dash-lg" style="color: #000;"></i></div>
                            <div class="px-2 d-flex justify-center items-center w-6">{{$quantity}}</div>
                            <div class="bg-yellow-500 rounded-full h-6 w-6 d-flex items-center justify-center  ml-1 cursor-pointer" wire:click="increaseQuantity"><i class="bi bi-plus-lg" style="color: #000;"></i></div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                         
                           @if(number_format($totalValue ,2) == "0.00" || number_format($totalValue ,2) == $data->price)
                           <div style="font-size: 16px;font-weight: 600; color: #000;">$.{{$data->price}} </div>
                           @else
                                <div style="font-size: 16px;font-weight: 600; color: var(--color-primary);">$.{{number_format($totalValue ,2)}}</div>
                           @endif
                          <div class="d-flex">
                            
                            <button class="btn add" wire:target="addtocart" wire:loading.attr="disabled"><a>Add Item <i class="bi bi-cart-fill" ></i> </a></button>
                        </div>
                         
                        
                      </div>
                      <div class="loading" wire:loading>
                        <div class="load">
                          <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              @empty
                <div>No MENU</div>
              @endforelse 
            </div>
            
            @empty
            <div>NO Data</div>

            @endforelse
        
</div>

                          
