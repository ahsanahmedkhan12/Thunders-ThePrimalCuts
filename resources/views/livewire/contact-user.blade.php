<div>
    <form method="post" wire:submit.prevent="submit" role="form" class="php-email-form p-3 p-md-4">
        @csrf
        <div class="row">
            <div class="col-xl-4 form-group">
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-xl-4 form-group">
              <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model="email" id="email" placeholder="Your Email" >
              @error('email')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
            <div class="col-xl-4 form-group">
              <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" id="phone" placeholder="Your Phone" >
              @error('phone')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
              @enderror
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('subject') is-invalid @enderror" wire:model="subject" id="subject" placeholder="Subject" >
                @error('subject')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group">
            <textarea class="form-control @error('message') is-invalid @enderror" wire:model="message" rows="5" placeholder="Message" ></textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="text-center d-flex justify-center"><button class="d-flex align-items-center contactbtn" wire:target="submit" wire:loading.attr="disabled">Send Message  <div style="width: 1rem;height: 1rem; margin-left: 5px;" class="spinner-grow text-light my-2" wire:loading wire:target="submit" role="status" ><span class="sr-only"></span></div></button></div>

    </form>
</div>
