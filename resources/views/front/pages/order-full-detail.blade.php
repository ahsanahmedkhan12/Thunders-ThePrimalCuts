@extends('front.layout.layout')
@section('title') order full detail @endsection
@section('keyword') @endsection
@section('description') @endsection
@section('contant')
<div>
	<div class="container my-4">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-12">
				@include('front.common.sidebar')
			</div>
			<div class="col-lg-9 col-md-8 rightside">
				<h4>Order Full Detail</h4>
                <hr>
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
     

@endsection