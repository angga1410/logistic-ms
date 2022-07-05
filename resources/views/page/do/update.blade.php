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
        <h4><i class="fas fa-truck"></i> &nbsp&nbsp Update Delivery Order </h4>

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
        <form method="post" action="{{url('/do/saveupdate')}}">
          {!! csrf_field() !!}
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Delivery Order#</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="DO Number" value="{{$do->do_num}}" name="do_num">
            </div>
          </div>
          <div class="form-group m-form__group" hidden >
             
              <input type="text" class="form-control m-input" name="id" style="border: none;" value="{{$do->id}}">
            </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>RFS #</label>
                <input type="text" class="form-control" name="rfs_id" value="{{$do->rfs_id}}" disabled>
                
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Delivery Order Date </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="date" class="form-control float-right"  name="do_date" value="{{$do->do_date}}">
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Request By</label>
                <input type="text" class="form-control float-right requested"  name="requested_by" value="{{$do->requested_by}}">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>PIC in Site</label>
                <input type="text" class="form-control float-right requested" value="{{$do->pic}}" id="reservation" name="pic">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Ref DO Lama</label>
                <input type="text" class="form-control float-right"  name="ref_do" value="{{$do->ref_do}}">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer Name </label>
                <div class="input-group">
                  <div class="input-group-prepend">

                  </div>
                  <input type="text" class="form-control float-right customer" value="{{$do->customer_name}}"  disabled>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Fowarder</label>
                <select class="form-control select2 forwarder" style="width: 100%;" name="mover_id">
                  <option></option>
                  @foreach ($mover as $po_nums)
                  @if($po_nums->id == $do->mover_id)
                  <option value="{{$do->mover_id}}" data="{{$po_nums->contact}}"   selected="">{{$do->mover->name}}</option>
                  @else
                  <option value="{{$po_nums->id}}" data="{{$po_nums->contact}}" >{{$po_nums->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Forwarder Contact Number </label>
                <div class="input-group">
                  <div class="input-group-prepend">

                  </div>
                  <input type="text" class="form-control float-right contact" value="{{$do->mover->contact}}">
                </div>
              </div>


              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Shipping Address </label>
                <div class="input-group">
                  <div class="input-group-prepend">

                  </div>
                  @if ($do->site_id == 0)
                  <textarea class="form-control site" rows="3" placeholder="" disabled>{{$do->address}}</textarea>
                  @else
                  <textarea class="form-control site" rows="3" placeholder="" disabled>{{$do->sites->address}}</textarea>
                  @endif
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Note </label>
                <div class="input-group">
                  <div class="input-group-prepend">

                  </div>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="remark">{{$do->remark}}</textarea>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input reference_id" style="border: none;" >
            </div>
            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input siteid" style="border: none;" >
            </div>
          </div>


          <!-- /.row -->

          <!-- /.row -->

          <!-- /.row -->


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">


                </div>
                <!-- /.card-header -->
                <div class="form-group">
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap form-group" id="data">
                    <thead>
                  <tr>
                    <th>ID</th>
                    <th>MFR</th>
                    <th>Part Name</th>
                    <th>Part Number</th>
                    <th>Part Desc</th>
                    <th>UM</th>
                    <th>QTY</th>
                   
                  </tr>
                  @foreach($do_item as $items)
                  <tr>
                  
                    <td>{{$items->products->id}}</td>
                    <td>{{$items->products->mfr}}</td>
                    <td>{{$items->products->part_name}}</td>
                    <td>{{$items->products->part_num}}</td>
                    <td><textarea class="form-control m-input" disabled>{{$items->products->part_desc}}</textarea></td>
                    <td>{{$items->products->default_um}}</td>
                    <td> {{$items->qty}}</td>
                   
                  </tr>
                  @endforeach
                </thead>
                      <tbody>

                    </table>

                  </div>
                </div>


              </div>
            </div>
            <!-- /.card-body -->
          </div>

          <button type="submit" class="btn btn-info btn-lg">Submit</button>
          <button type="" class="btn btn-default btn-lg float-right">Cancel</button>

          <!-- /.card -->
        </form>
      </div>
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
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button



    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

  $(function() {

    $(".document_no").on("change", function() {
      $('.reference_id').val('');
      $(".qc-tr").remove();
      var referenceId = $(this).find('option:selected').attr('data');
      console.log(referenceId);



    



    });

  });

  $(function() {

    $(".site").on("change", function() {
      $('.address').val('');
      var referenceId = $(this).find('option:selected').attr('data');
      var type = $(this).find('option:selected').attr('type');
      $(".address").val(referenceId);
    });

  });
  $(function() {

    $(".forwarder").on("change", function() {
      $('.contact').val('');
      var referenceId = $(this).find('option:selected').attr('data');
      var type = $(this).find('option:selected').attr('type');
      $(".contact").val(referenceId);
    });

  });
</script>
@endsection