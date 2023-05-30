@extends('back.layout.layout')
@section('title') {{$title}} @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant') 

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/control-area/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">  
       
              @if(empty($branchdata['id']))
                 @livewire('add-edit-branch')
              @else 
                  @livewire('add-edit-branch',['id' => $branchdata['id']])
              @endif
     
          </div> 
        </div>
      </div>
    </section>  
</div> 

@endsection
