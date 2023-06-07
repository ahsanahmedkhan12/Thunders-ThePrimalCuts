@extends('back.layout.layout')
@section('title') Order Full Detail @endsection
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
              <li class="breadcrumb-item active">Order Full Detail</li>
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
                        <h3 class="card-title">Order Full Detail</h3>
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
                      <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Menu_Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Sub_Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order->orderdetail as $key => $orders)
                    <tr>
                      <th scope="row">1</th>
                      <td>{{$orders->menu->name}}</td>
                      <td>{{$orders->quantity}}</td>
                      <td>{{number_format($orders->subtotal)}}</td>
                    </tr>
                   
                  @endforeach
                  </tbody>
                </table>
                    </div>    
                </div>
            </div>
     
          </div> 
        </div>
      </div>
    </section>  
</div> 

@endsection
