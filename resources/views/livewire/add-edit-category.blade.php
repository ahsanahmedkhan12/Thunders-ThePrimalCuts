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
                 <div>
                    <h5>Branch Area Section : </h5>
                    <hr>
                 </div>
                <div class="form-row">

                    <div class="form-group col-md-6" wire:ignore>
                        <label>Branch: <sup class="red" style="font-size: 16px;">*</sup></label>
                        <select class="select2  rounded-0 form-control @error('branch') is-invalid @enderror" style="width: 100%;" wire:model="branch"multiple="multiple" data-placeholder="Select a branch" >
                             <option value="" >Select branch</option>
                             @forelse ($branchdata as $index => $branhes)
                                 
                                <option value="{{ $branhes->id }}" >{{Str::title( $branhes->name) }}</option>
                             @empty
                                <option >No Data</option>
                              @endforelse
                        </select>
                        @error('branch')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </div>
                </div> 
                
                <div>
                    <h5>Category Area Section : </h5>
                    <hr>
                 </div>

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
<script type="text/javascript">
     $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
         theme: 'bootstrap4'
      }).on('change', function(){
        @this.branch = $(this).val();
      });
    });
</script>
@endpush
