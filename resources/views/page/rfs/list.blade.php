@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <style type="text/css">
table {
  counter-reset: row-num -1;
}
table tr {
  counter-increment: row-num;
}
table tr td:first-child::before {
    content: counter(row-num);
}
</style>
      <div class="container-fluid">
     
       
           

            <div class="card">
              <div class="card-header">
              <h4><i class="fas fa-file-import"></i> &nbsp&nbspRequest for Shipment</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered" id="table">
           <thead>
              <tr>
                 <th> No </th>
								 <th>RFS#</th>
                 <th>PO#</th>
                 <th>RFS Date</th>
                 <th>Customer</th>
                
                 <th>Requested By</th>
               
                 <th>Status</th>
              </tr>
           </thead>
        </table>
              </div>
           
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        
          <!-- /.col -->
        </div>
        <!-- /.row -->
   
  
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    
    $('#table').DataTable({
      responsive: true,
      autoWidth: false,
      paging: true,
               processing: true,
               serverSide: true,
               ajax: "{{ route('getdatarfs') }}",
               columns: [   {data :'null', name: 'null'},
                        { data: 'rfs_num', name: 'rfs_num' },
                        { data: 'po_num', name: 'po_num' },
                        { data: 'rfs_date', name: 'rfs_date' },
                        { data: 'customer_name', name: 'customer_name' },
                       
                        { data: 'requested_by', name: 'requested_by' },
                        { data: 'status', name: 'status' },
                     
                      

                     ]
            });
  });
</script>

@endsection
