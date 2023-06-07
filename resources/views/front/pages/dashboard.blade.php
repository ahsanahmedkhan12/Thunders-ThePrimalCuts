@extends('front.layout.layout')
@section('title') user dashboard @endsection
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
				<h4>Dashboard</h4>
                
				<h5>Order Area : </h5>
				<hr>
				<div class="row">
					<div class="col-lg-3 col-6">
			            <!-- small box -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>{{$ordertotal}}</h3>

			                <p>Orders</p>
			              </div>
			              <div class="icon">
			                <i class="bi bi-cart-fill"></i>
			              </div>
			              <a href="{{url('user/order-history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			            </div>
			        </div>
			        <div class="col-lg-3 col-6">
			            <!-- small box -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>{{$completetotal}}</h3>

			                <p>Complete Orders</p>
			              </div>
			              <div class="icon">
			                <i class="bi bi-bag-check-fill"></i>
			              </div>
			              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			            </div>
			        </div>
			        <div class="col-lg-3 col-6">
			            <!-- small box -->
			            <div class="small-box bg-danger">
			              <div class="inner">
			                <h3>{{$pendingtotal}}</h3>

			                <p>Pending Orders</p>
			              </div>
			              <div class="icon">
			                <i class="bi bi-bag-x-fill"></i>
			              </div>
			              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			            </div>
			        </div>
				</div>
				<h5>Payment Area : </h5>
				<hr>
				<div class="row">
					<div class="col-lg-3 col-6">
			            <!-- small box -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>Rs.{{number_format($sumtotal)}}</h3>

			                <p>Total Amount </p>
			              </div>
			              <div class="icon">
			                <i class="bi bi-wallet2"></i>
			              </div>
			              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			            </div>
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection