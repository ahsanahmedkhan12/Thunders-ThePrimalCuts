@extends('back.layout.layout')
@section('title') branches @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant') 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Branches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/control-area/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Branches</li>
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
                <h3 class="card-title">Branches</h3>
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
                <a href="{{url('/control-area/add-branch')}}" class="btn btn-exp btn-sm m-0 "  data-toggle="modal" data-target="#myModal" > Add Branch</a> 
       
                </div>
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
                          <th>Sku</th>
                          <th>Image</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Status</th>
                          <th>P_Status</th>
                          <th>D_Status</th>
                          <th>Created_at</th>
                          <th style="width: 80px;">Action</th>
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
                    url: "/control-area/branches",
                },
                columns: [

                    {data: 'checkbox',orderable: false,searchable: false},
                    {data: 'branchname',orderable: false}, 
                    {data: 'branchsku',orderable: false}, 
                    {data: 'branchimage',orderable: false}, 
                    {data: 'branchphone',orderable: false}, 
                    {data: 'branchaddress',orderable: false}, 
                    {data: 'branchstatus',orderable: false},  
                    {data: 'pickupstatus',orderable: false}, 
                    {data: 'delivarystatus',orderable: false},  
                    {data: 'created_at',orderable: false},
                    {data: 'action',orderable: false,searchable: false}
                ]
        });
        
    });

</script>        

@endsection