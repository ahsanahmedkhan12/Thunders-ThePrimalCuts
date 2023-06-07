@extends('back.layout.layout')
@section('title') categories @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant') 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View User Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/control-area/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User Contact</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          	<span id="form_success"></span>
            <span id="status_message_success"></span>
            <span id="form_error"></span>
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span><i class="fa fa-check"></i> {{ session('success') }}</span>
                </div>
            @endif 
                              
            
            <div class="card">
            	
              <div class="card-header">
                <h3 class="card-title">User Contact</h3>
                <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              	@can('isAdmin')   
                
              	<div class="btn-group">
                <button class="btn btn-danger btn-sm selectdel" ><i class="fa fa-trash-o"></i>Selected Data Delete</button> 
                </div>
                <div class="btn-group">
                <button class="btn btn-danger btn-sm alldel" ><i class="fa fa-trash-o"></i>All Data Delete</button> 
                </div>
                @endcan   

                    <table id="myTable" class="table table-bordered" style="width: 100%">
                      <thead>
                        <tr>
                          <th style="width: 10px"> <input type="checkbox" name="tag_checkbox" class="checkboxall" ></th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Subject</th>
                          <th>Message</th>
                          <th>Created_at</th>
                          
                        </tr>
                      </thead>       
                    </table>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </section>
  </div>
<script type="text/javascript">

    $(document).ready(function(){

        $('#myTable').DataTable({
           "pageLength": 100,
           "order": [[ 1, "desc" ]],
                processing: true,
                serverSide: true,
                ajax: {
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/control-area/user-contacts",
                },
                columns: [

                    {data: 'checkbox',orderable: false,searchable: false},
                    {data: 'cname',orderable: false}, 
                    {data: 'cemail',orderable: false}, 
                    {data: 'cphone',orderable: false}, 
                    {data: 'csubject',orderable: false}, 
                    {data: 'cmessage',orderable: false},  
                    {data: 'ccreated_at',orderable: false},
                ]
        });
        
    });

</script>        

@endsection