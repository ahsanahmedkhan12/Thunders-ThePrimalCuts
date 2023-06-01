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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <input id="name" type="text" class=" rounded-0 form-control @error('name') is-invalid @enderror"  wire:model="name" placeholder="Enter The Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image: <sup class="red" style="font-size: 16px;">*</sup></label>
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
                        <label>Phone: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input id="phone" type="text" class=" rounded-0 form-control @error('phone') is-invalid @enderror" placeholder="Enter the phone"  wire:model="phone"  data-inputmask='"mask": "(99) 999-9999999"' data-mask>
                             
                   
                              @error('phone')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                      
                    </div>

                    <div class="form-group col-md-6">
                        <label>Address: <sup class="red" style="font-size: 16px;">*</sup></label>
                         <input id="address" type="text" class=" rounded-0 form-control @error('address') is-invalid @enderror"  wire:model="address" placeholder="Enter The Address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div> 
                </div> 
                <div>
                    <h3>Branch Timming : </h3>
                    <hr>
                    
                </div>
                  <div class="form-row">
                    <div class="form-group col-md-4" wire:ignore>
                        <label>Week Day: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <select class="select2  rounded-0 form-control @error('weekday') is-invalid @enderror" multiple="multiple" data-placeholder="Select a week day" style="width: 100%;" wire:model="weekday">
                             
                             @forelse ($weekdaydata as $index => $weekdaydatas)
                                <option value="{{ $weekdaydatas->id }}" >{{Str::ucfirst( $weekdaydatas->title) }}</option>
                             @empty
                                <option >No Data</option>
                              @endforelse
                        </select>
                        @error('weekday')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4" wire:ignore.self>
                        <label>Start Time: <sup class="red" style="font-size: 16px;">*</sup></label>
                        
                         <div class="input-group date" id="timepicker" data-target-input="nearest" data-timepicker="@this">
                             <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                         <input id="starttime" type="text" class="12h rounded-0 datetimepicker-input form-control @error('starttime') is-invalid @enderror"  wire:model="starttime" data-target="#timepicker"  > 
                           @error('starttime')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       
                        </div>
                          
                    </div> 
                      <div class="form-group col-md-4"  wire:ignore.self>
                        <label>Closed Time: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <div class="input-group date" id="timepicker2" data-target-input="nearest" data-timepicker2="@this">
                              <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                             <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                            <input id="closetime" type="text" class="12h rounded-0 datetimepicker-input form-control @error('closetime') is-invalid @enderror"  wire:model="closetime" data-target="#timepicker2" > 
                             @error('closetime')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                     
                    </div> 
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
         theme: 'bootstrap4'
      }).on('change', function(){
        @this.weekday = $(this).val();
      });
    });
        //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    });
    $('#timepicker').on('change.datetimepicker', function(){
        let starttime = $(this).data('timepicker');
        eval(starttime).set('starttime',  $('#starttime').val());
      });
    $('#timepicker2').datetimepicker({
      format: 'LT'
    });
    $('#timepicker2').on('change.datetimepicker', function(){
        let closetime = $(this).data('timepicker2');
        eval(closetime).set('closetime',  $('#closetime').val());
      });


    $('#phone').on('change', function(){
        @this.phone = $(this).val();
      });

</script>
@endpush
