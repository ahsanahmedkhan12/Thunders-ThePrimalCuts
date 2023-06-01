<div>        
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$titlename}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
             
        <div class="card-body">
              
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form  id="add-update-list"  wire:submit.prevent="submit" method="post" enctype="multipart/form-data">
                @csrf 
                <div class="">
                    <h5>Relationship Area Section : </h5>
                    <hr>
                    <div class=" add-input">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <label>Branch Name : </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-9">
                                <label>Category: </label>
                            </div>
                                       
                            <div class="col-md-1 col-sm-1 col-3">
                                <label>Action</label>    
                            </div>
                        </div>
                    </div>
                    @foreach ($relationship as $i => $relationshipes)
                    <div class=" add-input">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="rounded-0 form-control @error('relationship.' .$i. '.branch') is-invalid @enderror" style="width: 100%;" wire:model="relationship.{{$i}}.branch" >
                                         <option value="" selected>Select branch</option>
                                         @forelse ($branchdata as $key => $branhes)
                                             
                                            <option value="{{ $branhes->id }}" >{{Str::title( $branhes->name) }}</option>
                                         @empty
                                            <option >No Data</option>
                                          @endforelse
                                    </select>
                                    @error('relationship.' .$i. '.branch')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-sm-5 col-9" >
                                <div class="form-group">
                                     <select class="select2  rounded-0 form-control @error('relationship.' .$i. '.category') is-invalid @enderror" style="width: 100%;" wire:model="relationship.{{$i}}.category" @if (!$relationship[$i]['branch']) disabled @endif>
                                        <option value="" selected>Select category</option>
                                  
                                   @if(!empty($relationship[$i]['categorydata']))
                                    @forelse ($relationship[$i]['categorydata'] as $cat)
                                      
                                        <option value="{{ $cat->id }}">{{Str::title( $cat->name) }}</option>
                                      
                                    @empty
                                    <option>no data</option>

                                    @endforelse
                                   @endif
                                    </select>
                                    @error('relationship.' .$i. '.category') 
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>            
                            <div class="col-md-1 col-sm-1 col-3">                   
                                    <button class="btn btn-danger btn-md" wire:click.prevent="removerelationship({{$i}})">remove</button>
                            </div>
                            <div class=" mb-4" wire:loading wire:target="removerelationship({{$i}})"  role="status"><span class="spinner-border text-primary"></span> Loading...
                            </div>
                        </div>
                    </div>
                    @endforeach

                     <div class=" mb-4" wire:loading wire:target="addrelationship"  role="status"><span class="spinner-border text-primary"></span> Loading...
                    </div>
                    <br>
                    <div><button class="btn text-white btn-success btn-md" wire:click.prevent="addrelationship"> + Add</button></div>
                  </div> 
                 
                <div>
                    <h5>Menu Area Section : </h5>
                    <hr>
                 </div>

                <div class="form-row">
                    <div class="form-group col-md-6" wire:ignore.self>
                        <label>Name: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <input id="name" type="text" class=" rounded-0 form-control @error('name') is-invalid @enderror"  wire:model="name" placeholder="Enter The Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image: <sup class="red" style="font-size: 16px;" >*</sup></label>
                         <input id="image" type="file" class=" rounded-0 form-control @error('image') is-invalid @enderror"  wire:model="image" >
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div> 
                </div> 

                <div class="form-row">
                    <div class="form-group col-md-6" wire:ignore.self>
                        <label>Price: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                       
                            
                              <input id="price" type="text" class=" rounded-0 form-control @error('price') is-invalid @enderror"  wire:model="price" placeholder="Enter the price" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" data-mask >
                              <br>
                              @error('price')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                      
                    </div>
                    <div class="form-group col-md-6">
                        <label>Description: </label>
                        <input id="description" type="text" class=" rounded-0 form-control @error('description') is-invalid @enderror"  wire:model="description" placeholder="Enter the description">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                 <div class="listattribute">
                    <h5>Add-On Menu Area Section : </h5>
                  
                    <hr>
                    <div class=" add-input">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <label>Add-On Name : </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-9">
                                <label>Add-On Price: </label>
                            </div>
                                       
                            <div class="col-md-1 col-sm-1 col-3">
                                <label>Action</label>    
                            </div>
                        </div>
                    </div>
                    @foreach ($addonmenu as $index => $addonmenus)
                    <div class=" add-input">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="rounded-0 form-control inputnumber @error('addonmenu.' .$index. '.addonname') is-invalid @enderror" wire:model="addonmenu.{{$index}}.addonname" placeholder="Enter the name">
                                    @error('addonmenu.' .$index. '.addonname')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-9" >
                                <div class="form-group">
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                     <input type="text" class="rounded-0 form-control inputnumber @error('addonmenu.' .$index. '.addonprice') is-invalid @enderror" wire:model="addonmenu.{{$index}}.addonprice" placeholder="Enter the price"  >
                                   
                                    
                                    @error('addonmenu.' .$index. '.addonprice') 
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror
                                </div>
                                </div>
                            </div>            
                            <div class="col-md-1 col-sm-1 col-3">                   
                                    <button class="btn btn-danger btn-md" wire:click.prevent="Removeaddonmenu({{$index}})">remove</button>
                                </div>
                            </div>
                            <div class=" mb-4" wire:loading wire:target="Removeaddonmenu({{$index}})"  role="status"><span class="spinner-border text-primary"></span> Loading...
                        </div>
                    </div>
                    @endforeach

                     <div class=" mb-4" wire:loading wire:target="Addaddonmenu"  role="status"><span class="spinner-border text-primary"></span> Loading...
                    </div>
                    <br>
                    <div><button class="btn text-white btn-success btn-md" wire:click.prevent="Addaddonmenu"> + Add</button></div>
                  </div> 
                
                <button wire:target="submit" wire:loading.attr="disabled"  class="btn2 btn-exp d-flex my-2"><p class="d-flex my-2 mx-2 align-self-center">{{$titlename}} </p>       
                      <div class="spinner-grow text-light my-2" wire:loading wire:target="submit" role="status" >
                        <span class="sr-only">Loading...</span>
                      </div>
                </button> 

            </form>
        </div>    
    </div>
</div>
@push('js')
<script>

     $('#price').on('change', function(){
        @this.price = $(this).val();
      });
   
     

</script>
@endpush
