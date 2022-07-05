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
                <h3 class="card-title">Costomer Site List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered" id="table">
           <thead>
              <tr>
                 <th> No </th>
								 <th>Customer Name</th>
                 <th>Site Name</th>
                 <th>Address</th>
                
               
               
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
               ajax: "{{ route('getdatasite') }}",
               columns: [   {data :'null', name: 'null'},
                        { data: 'site_name', name: 'site_name' },
                        { data: 'name', name: 'name' },
                        { data: 'address', name: 'address' },
                      

                     ]
            });
  });
</script>

@endsection
