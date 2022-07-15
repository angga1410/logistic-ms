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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Return DO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('/do/status-update')}}">
          {!! csrf_field() !!}
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
            <select class="form-control select2 forwarder" style="width: 100%;" name="status">
                  <option></option>
               
                  <option value="3">Successfully Delivered</option>
                  <option value="4">Problem</option>
               
               
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
              <textarea type="text" name="status_remark" class="form-control" ></textarea>
            </div>
          </div>

          <input type="hidden" name="do_id" class="do_id">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>

        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Status DO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('/do/status-update')}}">
          {!! csrf_field() !!}
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
            <select class="form-control select2 forwarder" style="width: 100%;" name="status">
                  <option></option>
               
              
                  <option value="5">Take Down</option>
                  <option value="0">Re-create</option>
               
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
              <textarea type="text" name="status_remark" class="form-control" ></textarea>
            </div>
          </div>

          <input type="hidden" name="do_id" class="do_id">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>

        </form>
      </div>
    </div>
  </div>
</div>
      <div class="container-fluid">
     
       



            <div class="card">
              <div class="card-header">
              <h4><i class="fas fa-truck"></i>&nbsp&nbspDelivery Order</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered" id="table">
           <thead>
              <tr>
                 <th> No </th>
								 <th>DO#</th>
                 <th>Ref DO#</th>
                 <th>DO Date</th>
                 <th>Customer</th>
                 <th>Send To</th>
                 <th>Request By</th>
                 <th>PIC In Site</th>
                 <th>Mover Name</th>
                 <th>Note</th>
                 <th>Status</th>
                 <th>Action</th>
               
              </tr>
           </thead>
        </table>
              </div>
              <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Purchase Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-arrow-down"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px"></sup></h3>

                <p>RFS Done</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>44</h3>

                <p>RFS Outstanding</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>RFS Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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
      scrollY: 550,
               info:false,
            dom: 'Bfrtip',
    paging: false,
               processing: true,
               serverSide: true,
               ajax: "{{ route('getdatado') }}",
               columns: [   {data :'null', name: 'null'},
                        { data: 'do_num', name: 'do_num' },
                        { data: 'ref_do', name: 'ref_do' },
                        { data: 'do_date', name: 'do_date' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'site', name: 'site' },
                        { data: 'requested_by', name: 'requested_by' },
                        { data: 'pic', name: 'pic' },
                        { data: 'mover', name: 'mover' },
                        { data: 'remark', name: 'remark' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action' },
                      

                     ]
            });
  });

  function updateStatus(do_id){
    $('#exampleModalCenter').modal('show'); 
    $('.do_id').val(do_id); 
  }
  function updateStatus2(do_id){
    $('#exampleModalCenter2').modal('show'); 
    $('.do_id').val(do_id); 
  }
</script>

@endsection
