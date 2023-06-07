@extends('front.layout.layout')
@section('title') order history @endsection
@section('keyword') @endsection
@section('description') @endsection
@section('contant')
<div>
	<div class="container my-4">
		<div class="row">
			@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
			<div class="col-lg-3 col-md-4 col-12">
				@include('front.common.sidebar')
			</div>
			<div class="col-lg-9 col-md-8 rightside">
				<h4>Order History</h4>
				 <div class="card-body table-responsive">
              	  

                    <table id="myTable" class="table table-bordered" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Branch</th>
                          <th>Order_Code</th>
                          <th>Payment_Status</th>
                          <th>Order_Status</th>
                          <th>Subtotal</th>
                          <th>Discount</th>
                          <th>Total_Payable</th>
                          <th>Delivery_Time</th>
                          <th>Created_at</th>
                          <th>Action</th>             
                        </tr>
                      </thead>       
                    </table>
              </div>
			</div>
		</div>
	</div>
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
                    url: "/user/order-history",
                },
                columns: [
                    {data: 'ubranch',orderable: false}, 
                    {data: 'uordercode',orderable: false}, 
                    {data: 'upaymentstatus',orderable: false}, 
                    {data: 'uorderstatus',orderable: false}, 
                    {data: 'usubtotal',orderable: false},  
                    {data: 'udiscount',orderable: false}, 
                    {data: 'utotalpayable',orderable: false}, 
                    {data: 'udeliverytime',orderable: false}, 
                    {data: 'ucreated_at',orderable: false},  
                    {data: 'action',orderable: false,searchable: false}
                ]
        });
        
    });

</script>        

@endsection