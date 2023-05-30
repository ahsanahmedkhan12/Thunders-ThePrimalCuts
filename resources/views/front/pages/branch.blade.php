@extends('front.layout.layout')
@section('title') Halal food Restaurant New York, Jersey City, Long Island | Sammy’s Halal @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
<section id="hero" class="hero d-flex align-items-center ">
    <div class="container">
    	@forelse($branch as $key => $branchdata)
    	<div class="resturants-box" style="margin:20px 0px;" data-aos="fade-up" data-aos-delay="100">
            <div class="row  gy-4">
                <div class="col-lg-6 col-md-6 col-12 " style="text-align: left;">
                    <img src="{{$branchdata->imagePath}}" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6 col-12 resturants-box-right" style="    margin-top: 50px;">
                    <h4 style="padding-top:10px;">{{Str::title($branchdata->name)}}</h4>
                    <p style="margin-bottom: 10px;font-size: 16px;color: #6e6e6e;">{{Str::title($branchdata->address)}}</p>
                
                    <p style="margin-bottom: 15px;font-size: 14px;font-weight: 600;">Timming :<a href="#"  data-toggle="modal"  data-target="#{{$branchdata->id}}"> View Time</a></p>
                  
                    <div class="d-flex align-items-center justify-content-center"> 
                        <a href="tel:{{$branchdata->phone}}" class="btn-book" style="margin-right: 10px;"><i class="bi bi-phone"></i><span>{{$branchdata->phone}}</span></a>
                        <a href="{{ url('/branch/'.$branchdata->slug) }}" class="btn-book">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="swiper-slide  ">
                <div class="" data-aos="fade-up" data-aos-delay="200">
                    <div class="resturants-box">
                        <h4 class="text-center">No Data</h4>
                    </div>
                </div>
            </div>        
        @endforelse
    </div>
</section>
@endsection