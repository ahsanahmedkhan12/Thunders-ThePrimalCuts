@extends('front.layout.layout')
@section('title') Menu of {{Str::title($branchdata->name)}}  | Sammy’s Halal @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
<section  class="h  align-items-center ">
	<div class="menu-img"></div>
	<img src="{{asset('assets/img/banner-menu.jpg')}}" width="100%">
    <div class="container">
        <div class="branchtitle"><a href="{{url('/')}}" style="color: #fff;"> Home </a> / {{Str::title($branchdata->name)}}</div>
        <div class="mainmenu">
        	<div class="section-header">
	          <h2 style="font-size: 16px;">Menu</h2>
	          <p style="font-weight: 600;">Branch <span>{{Str::title($branchdata->name)}}</span></p>
	        </div>
        
        	<div >
			    <div class="d-flex">
			       <div class="ser-prev arro fas fa-angle-left" style="display: none;"></div>
			      <div class="ser-next arro fas fa-angle-right" style="margin-left: 5px"></div>
			      </div>
			     
			      <div class="scrollmenu">
			        <div class="services-sub-nav">
			          <ul>
			            @forelse($category as $key => $value) 
			            <li> <a class="ser-item filter-button" href="#{{$value->slug}}">{{$value->name}}</a></li> 
			            @empty
			               <li>No Data</li> 
			            @endforelse
			          </ul>
			      </div>   
			      </div>
			         
			    </div>

			@livewire('show-menu',['slug' => $branchdata->slug])
        </div>
    </div>
</section>
@endsection