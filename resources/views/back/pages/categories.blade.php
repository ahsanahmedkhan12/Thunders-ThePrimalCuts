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
            <h1>View Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/control-area/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title">Categories</h3>
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
                <a href="{{url('/control-area/add-category')}}" class="btn btn-exp btn-sm m-0 "  data-toggle="modal" data-target="#myModal" > Add Category</a> 
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
                          <th>Branch_Name</th>
                          <th>Name</th>
                          <th>Sku</th>
                          <th>Image</th>
                          <th>Status</th>
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
                    url: "/control-area/categories",
                },
                columns: [

                    {data: 'checkbox',orderable: false,searchable: false},
                    {data: 'branchname',orderable: false}, 
                    {data: 'catname',orderable: false}, 
                    {data: 'catsku',orderable: false}, 
                    {data: 'catimage',orderable: false}, 
                    {data: 'catstatus',orderable: false},  
                    {data: 'catcreated_at',orderable: false},
                    {data: 'action',orderable: false,searchable: false}
                ]
        });
        
    });

      $(document).on('click', '.selectdel', function(){
            var rid = [];
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $('.checkboxsingle:checked').each(function(){
                    rid.push($(this).val());
                });
                if(rid.length > 0)
                {
                    $.ajax({
                        url:"/control-area/category-selected-delete/"+rid,
                        method:"get",
                        dataType:"json",
                        data:{id:rid},
                        success:function(data)
                        {
                            if(data.success){
                            var successmsg = '';
                            successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 3000);
                             setTimeout(function(){
                                 
                                    $('#myTable').DataTable().ajax.reload();
                                }, 1000);
                            $('#status_message_success').html(successmsg);   
                            }
                        }
                           
                    });
                }
                else
                {
                    alert("Please select atleast one checkbox");
                }
            }
      });
      $(document).on('click', '.alldel', function(){
            var categoryid = [];
            if(confirm("Are you sure you want to Delete all data?"))
            {
                $.ajax({
                    url:"/control-area/category-all-delete",
                    method:"get",
                    dataType:"json",
                        success:function(data)
                        {
                            if(data.success){
                            var successmsg = '';
                            successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 3000);
                             setTimeout(function(){
                                 
                                    $('#myTable').DataTable().ajax.reload();
                                }, 1000);
                            $('#status_message_success').html(successmsg);   
                            }else if (data.error){
                                var errormsg = '';
                                errormsg = '<div class="alert alert-danger">' + data.error + '</div>';
                                window.setTimeout(function() {
                                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                    });
                                }, 3000);
                                 setTimeout(function(){
                                     
                                        $('#myTable').DataTable().ajax.reload();
                                    }, 1000);
                                $('#status_message_success').html(errormsg);  
                            }
                        }
                           
                           
                        
                    });
               
            }
    });  


</script>        

@endsection