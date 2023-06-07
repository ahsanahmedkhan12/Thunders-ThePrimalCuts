@extends('back.layout.layout')
@section('title') Restore Database @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant') 

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Restore Database</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/control-area/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Restore Database</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">  
             
               <div>        
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Restore Database</h3>
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
                    @if (session('success'))
                          <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                     <form action="{{url('/control-area/restore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="backup_file">
                        <button class="btn btn-sm btn-primary" type="submit">Restore Backup</button>
                    </form>
                    </div>    
                </div>
            </div>
     
          </div> 
        </div>
      </div>
    </section>  
</div> 

@endsection
