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
        <h4><i class="fas fa-file-import"></i> &nbsp&nbsp Update Request for Shipment </h4>

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
      <form method="post" action="{{url('/rfs/saveupdate')}}">
      {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>RFS #</label>
              <input type="text" class="form-control" value="RFS/001/2020/001" readonly name="rfs_num">
            </div>
            <!-- /.form-group -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>RFS Date </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="date" class="form-control float-right" id="" name="rfs_date" required value="{{$rfs->rfs_date}}">
              </div>
            </div>
            <!-- /.form-group -->

          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Reference Type</label>
              <select class="form-control select2" style="width: 100%;" required>
                <option></option>
                <option>Purchase Order</option>
                <option>Demo Product</option>
              </select>
            </div>
            <div class="form-group">
              <label>Request By:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                </div>
                <input type="text" class="form-control" name="requested_by" required value="{{$rfs->requested_by}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form-group -->
            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input reference_id" name="po_id" style="border: none;" required="true" value="{{$rfs->id}}">
            </div>
            <div class="form-group m-form__group" hidden >
             
              <input type="text" class="form-control m-input" name="id" style="border: none;" required="true" value="{{$rfs->id}}">
            </div>
            <div class="form-group m-form__group" hidden >
             
             <input type="text" class="form-control m-input refsite" id="refsite" name="address" style="border: none;" required="true" value="{{$rfs->address}}">
           </div>
            <div class="form-group">
              <label> Site Name:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                </div>
                <input type="text" class="form-control ref_site"  disabled value="{{$rfs->customer_name}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- IP mask -->
            <div class="form-group">
              <label>Send To:</label>

              <div class="input-group">

                <select class="form-control select2 site" style="width: 100%;" name="site_id" required>
                @if($rfs->id == 0)
                <option value="0" data="0" selected="">Shipping Address</option>
                @foreach ($site as $sites)
                      <option value="{{ $sites->id }}" data="{{$sites->address}}">{{ $sites->name }}</option>
									@endforeach
                </select>
              @else
              <option value="0" data="0" selected="">Shipping Address</option>
                @foreach ($site as $sites)
@if ($sites->id == $rfs->site_id)
                <option value="{{ $siteid->id }}" data="{{$siteid->address}}"selected=""> {{ $siteid->name }}</option>
               
                @else
                      <option value="{{ $sites->id }}" data="{{$sites->address}}">{{ $sites->name }}</option>
                      @endif
                  @endforeach
                  @endif
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Address :</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <textarea class="form-control address" rows="2" placeholder="" name="address" disabled>{{$rfs->address}}</textarea>
              </div>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Reference Number</label>
              <div class="input-group">

             
                <input type="text" class="form-control float-right" id="" name="po_num" readonly value="{{$rfs->po_num}}" >

              </div>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Customer:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-shopping-bag"></i>
                  </span>
                </div>

                <input type="text" class="form-control float-right customer" id="" name="customer_name" readonly value="{{$rfs->customer_name}}" >
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Contact Person:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-user-friends"></i>
                  </span>
                </div>

                <input type="text" class="form-control float-right contact_person" name="contact_person" readonly value="{{$rfs->contact_person}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Contact Phone:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                </div>
                <input type="text" class="form-control float-right contact_hp" id="" name="contact_hp" readonly value="{{$rfs->contact_hp}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Note :</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <textarea class="form-control" rows="2" placeholder="" name="remark" required >{{$rfs->remark}}</textarea>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>

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
                  @foreach($item as $items)
                  <tr>
                  
                    <td>{{$items->products->id}}</td>
                    <td>{{$items->products->mfr}}</td>
                    <td>{{$items->products->part_name}}</td>
                    <td>{{$items->products->part_num}}</td>
                    <td><textarea class="form-control m-input qty_qc">{{$items->products->part_desc}}</textarea></td>
                    <td>{{$items->products->default_um}}</td>
                    <td> <input type="text" class="form-control" id="" name="" value="{{$items->qty}}"></td>
                   
                  </tr>
                  @endforeach
                </thead>
                <tbody>

              </table>

            </div>
            </div>

        <!-- /.row -->

        <!-- /.row -->

        <!-- /.row -->
        <button type="submit" class="btn btn-info btn-lg">Submit</button>
              <button type="" class="btn btn-default btn-lg float-right">Cancel</button>
              </form>
      </div>
   
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
             
            </div>
            <!-- /.card-header -->
        
            <div class="card-footer">
         
            </div>
          
          </div>
          <!-- /.card-body -->
        </div>

        <!-- /.card -->
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
      $('.num').val('');
      $(".qc-tr").remove();
      $('.site').empty().append('<option value="">Select Location</option>');
      $('.address').val('');
      var referenceId = $(this).find('option:selected').attr('data');
      var type = $(this).find('option:selected').attr('type');
      $(".reference_id").val(referenceId);

      

    });

  });

  $(function() {

$(".site").on("change", function() {
  $('.address').val('');
  var referenceId = $(this).find('option:selected').attr('data');
  var site = $("#refsite").val(); 
  console.log(site);

  if(referenceId != 0){
    $(".address").val(referenceId);
  }
  else{
    $(".address").val(site);
  }

});

});
  $('#data').on('click', '.deleteItem', function() {
    $(this).closest('tr').remove();
  });
</script>
@endsection