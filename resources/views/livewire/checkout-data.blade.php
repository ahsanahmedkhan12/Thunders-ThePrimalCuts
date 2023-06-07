<div class="container my-4">
    @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
    <div class="row">
        <div class="col-lg-7 col-md-6">
            <div class="boxshadow">
                @if($cartshowdata->count() > 0 )
                <h5>Branch Detail : </h5>
                <hr>
                <div class="d-flex align-items-center">
                    <div>
                         <img src="{{$branch->imagePath}}" width="100">
                    </div>
                    <div style="margin-left:10px; margin-top: 2px;">
                        <h6>{{$branch->name}}</h6>
                        <p class="m-0" style="font-weight: 400;color: #6e6e6e;">{{$branch->address}}</p>
                    </div>
                </div>
               
                <div class="d-flex justify-content-end">
                    <a href="tel:{{$branch->phone}}" class="btn-book" style="margin-right: 10px;"><i class="bi bi-phone"></i><span>{{$branch->phone}}</span></a>
                </div>
                @else
                    <div style="text-align: center;">
                        <img src="{{asset('assets/img/nodata.svg')}}" width="100px">
                        <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">The cart is empty.</div>
                    </div>
                @endif
            </div>
          
             <div class="boxshadow rightarea rightarea1">
                @if($cartshowdata->count() > 0 )
                 <ul style="text-align: center;">
                    <li class=" {{ $currentStep == 1 ? 'active' : '' }} {{ $currentStep > 1 ? 'activelight' : '' }} {{ $currentStep < 1 ? 'noactive' : '' }} "><a  id="s1">Slot Pickup Time</a></li>
                    <li class="{{ $currentStep == 2 ? 'active' : '' }} {{ $currentStep > 2 ? 'activelight' : '' }} {{ $currentStep < 2 ? 'noactive' : '' }} "><a id="s1">Detail</a></li>
                    <li class="{{ $currentStep == 3 ? 'active' : '' }} {{ $currentStep > 3 ? 'activelight' : '' }} {{ $currentStep < 3 ? 'noactive' : '' }} "><a id="s1">Payment</a></li>
               
                </ul>

          
                    <div class="step1 {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                         <div class="loading"  wire:loading wire:target="firstStepSubmit">
                            <div class="load">
                                <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between" style="    margin-top: 20px;">
                            <h5 class="m-0">Delivery Time Slot : </h5>                     
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Select Time Slot <sup class="red">*</sup></label>

                            <select class="rounded-0 form-control  @error('slottime') is-invalid @enderror" wire:model="slottime" style="width: 100%;"  >
                                <option selected value="">select time slot</option>
                            @foreach($pickupTimes as $timeslot)
                                <option value="{{$timeslot}}">{{$timeslot}}</option>
                            @endforeach
                            </select>
                            @error('slottime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="shw-delivery-time--small my-2">Your order will be delivered by<strong class="ng-binding">@if($slottime == null) no select slot time @else {{$slottime}} @endif</strong> </p>
                       
                        <div style="text-align: right; margin-top: 20px;">   <button class="btn btn-theme btn-lg pull-right" wire:click="firstStepSubmit" type="button">Next</button></div>   
                    </div>
                    @if($currentStep >= 2)

                    <div class="step2 {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                       
                        <div class="loading"  wire:loading wire:target="secondStepSubmit">
                            <div class="load">
                                <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
                            </div>
                        </div>

                        <h5 style=",margin-top: 20px;">Customer Detail : </h5>
                        <hr>
                        <form  id="add-update-list"  wire:submit.prevent="secondStepSubmit" method="post">
                            @csrf 
                            <div class="form-group">
                                <label>Name <sup class="red">*</sup></label>
                                <input type="text" wire:model="name" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="Your Name" >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="row"> 
                                <div class="col-xl-6 form-group">
                                  <label>Email <sup class="red">*</sup></label>
                                  <input type="text" class="form-control rounded-0 @error('email') is-invalid @enderror" wire:model="email" id="email" placeholder="Your Email" >
                                  @error('email')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                                </div>
                                <div class="col-xl-6 form-group">
                                  <label>Phone <sup class="red">*</sup></label>
                                  <input type="text" class="form-control rounded-0 @error('phone') is-invalid @enderror" wire:model="phone" id="phone" placeholder="Your Phone" >
                                  @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address <sup class="red">*</sup></label>
                                <input type="text" class="form-control rounded-0 @error('address') is-invalid @enderror" wire:model="address" id="address" placeholder="Enter the address" >
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Instructions <sup class="red">*</sup></label>
                                <input type="text" class="form-control rounded-0 @error('instruction') is-invalid @enderror" wire:model="instruction" id="instruction" placeholder="Enter the instruction" >
                                    @error('instruction')
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div  style="text-align: right;margin-top: 20px;">
                                <button class="btn btn-theme-back btn-lg pull-right" wire:click="back(1)" type="button" style="border: 1px solid;">Back</button>
                                <button class="btn btn-theme btn-lg pull-right" wire:click="secondStepSubmit" type="button">Next</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    @if($currentStep >= 3)

                    <div class="step3 {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                       
                        <div class="loading"  wire:loading wire:target="submitorder">
                            <div class="load">
                                <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
                            </div>
                        </div>

                 
                        <div style="margin: 15px 0px;" class="d-flex justify-content-between">
                            <div style="font-size: 20px; font-weight: 600;">Bill pay with card</div>
                            <form action="{{ url('/checkout-card/'.$slottime.'/'.$instruction)}}" method="POST">
                              @csrf
                              <button class="btn-book" style="margin-right: 10px;"><span>Pay </span></button>

                            </form>
                        </div>
                        <div style="margin: 15px 0px;" class="d-flex justify-content-between">
                            <div style="font-size: 20px; font-weight: 600;">Bill pay with cash on delivery</div>
                            <form method="post" wire:submit.prevent="submitorder">
                              @csrf
                              <button wire:target="submitorder" class="btn-book" style="margin-right: 10px;"><span>Pay </span></button>

                            </form>
                        </div>
               
                        <div  style="text-align: right;margin-top: 20px;">
                            <button class="btn btn-theme-back btn-lg pull-right" wire:click="back(2)" type="button" style="border: 1px solid;">Back</button>
                         
                        </div>
                    </div>
                    @endif
               
                @else
                    <div style="text-align: center;">
                        <img src="{{asset('assets/img/nodata.svg')}}" width="100px">
                        <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">The cart is empty.</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
           
            <div class="boxshadow" >
                @if($cartshowdata->count() > 0 )
                <div class="loading" wire:loading>
                    <div class="load">
                        <div class="spinner-border text-dark" role="status"><span class="sr-only"></span></div>
                    </div>
                </div>
                <h5>Your Bill : </h5>
                <hr>
                <table>
                    <thead style="font-size: 15px;">
                        <tr style="border-bottom: 1px solid #b5b5b5;">
                            <th width="400px">Item Name</th>
                            <th width="44px">Qty</th>
                            <th width="50px" style="text-align: center;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartshowdata as $key => $cartdata)
                        <tr style="border-bottom: 1px solid #b5b5b5;color: #999;">
                            <td class="cptdy"><span style="color:#000;"><strong>{{$cartdata->name}}</strong></span>
                                <br>
                                @if($cartdata->options->count() > 0)<strong
                                >{{$cartdata->options->count()}} ADD ONS:</strong><br>
                                    @foreach($cartdata->options as $i => $cart)
                                    @php
                                        $name = App\Models\AddOnMenu::where('id', '=', $cart)->first();
                                    @endphp
                                    @if($i > 0 && $cartdata->options->count() > 1) | @endif {{$name->name}}
                                    @endforeach
                           
                                @endif
                            </td>
                            <td class="cptdy">{{$cartdata->qty}}</td>
                            <th class="cptdy"><span style="color: #333;">Rs.{{number_format($cartdata->price)}}</span></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex align-items-center justify-content-between" style="margin-top: 20px;">
                    <h6>Items Price</h6>
                    @php $itemsprisce = str_replace('.00', '', $itemsprice); @endphp
               
                    <strong>Rs.{{$itemsprisce}}</strong>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <h6>New User Discount</h6>
                    <strong>0%</strong>
                </div>
                 <hr>
                <div class="d-flex align-items-center justify-content-between">
                    <h3>Payable</h3>
                    @php $numberWithoutDecimal = str_replace('.00', '', $payable); @endphp
                    <h3>Rs.{{$numberWithoutDecimal}}</h3>
                </div>
                @else
                    <div style="text-align: center;">
                        <img src="{{asset('assets/img/nodata.svg')}}" width="100px">
                        <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">The cart is empty.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
 