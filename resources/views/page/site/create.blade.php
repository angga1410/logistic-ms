@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h4><i class="fas fa-file-import"></i> &nbsp&nbsp Entry Customer Site </h4>

            <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form method="post" action="{{url('/site/save')}}">

          {!! csrf_field() !!}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Customer Name</label>
                  <select class="form-control select2 document_no" style="width: 100%;" name="site_name">
                  <option >Select Customer</option>
                  @foreach ($response as $cus)
                    <option value="{{$cus['text']}}" data="{{$cus['value']}}">{{$cus['text']}}</option>
                @endforeach
                  </select>
                </div>
                <!-- /.form-group -->
          
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                  <label>Site Name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <!-- /.input group -->
                </div>
               
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label>Address :</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <textarea class="form-control" rows="2" placeholder="" name="address"></textarea>
              </div>
            </div>
            <div class="form-group" hidden>
               

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    <input type="text" class="form-control reference_id" name="customer_id">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
            
              </div>
              <!-- /.col -->
            </div>
           

            <div class="card-footer">
                  <button type="submit" class="btn btn-info btn-lg">Submit</button>
                  <button type="" class="btn btn-default btn-lg float-right">Cancel</button>
                </div>
        <!-- /.row -->
  
        <!-- /.row -->
 
        <!-- /.row -->
      </div>
    
      </form>
        </div>

      <!-- /.container-fluid -->
    </section>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
    <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  

  });

  $(function(){
	
    $(".document_no").on("change",function(){
    $('.reference_id').val('');
    $(".qc-tr").remove();
    var referenceId = $(this).find('option:selected').attr('data');
    var type = $(this).find('option:selected').attr('type');
    $(".reference_id").val(referenceId);
    });

  });
  // DropzoneJS Demo Code End
</script>
@endsection