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
        <h4><i class="fas fa-truck"></i> &nbsp&nbsp Entry New Delivery Order </h4>

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
        <form method="post" action="{{url('/do/save')}}">
          {!! csrf_field() !!}
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Delivery Order#</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="DO Number" data-date-start-date="d" value="DO/{{date('Y/m/d', strtotime('0 day'))}}/" name="do_num">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>RFS #</label>
                <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                  <option>Select RFS#</option>
                  @foreach ($po as $po_nums)
                  @if($po_nums['id'] == "Outstanding")
                  <option value="{{$po_nums['id']}}" data="{{$po_nums['id']}}">{{$po_nums['rfsNumber']}} - {{$po_nums['poNumber']}} - {{$po_nums['accountName']}}</option>
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
                <label>Delivery Order Date </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="date" class="form-control float-right" id="reservation" name="do_date" required>
                </div>
              </div>
              <!-- /.form-group -->
              <input type="hidden" class="form-control float-right po_id" id="po_id" name="po_id">
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Referensi DO Lama</label>
                <input type="text" class="form-control float-right" id="reservation" name="ref_do">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Request By</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="requested_by">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>PIC in Site</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="pic">
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
                  <input type="text" class="form-control float-right customer" id="reservation" name="customer_name">
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
                  <option value="{{$po_nums->id}}" data="{{$po_nums->contact}}">{{$po_nums->name}}</option>
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
                  <input type="text" class="form-control float-right contact" id="reservation">
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
                  <textarea class="form-control site" name="address" rows="3" placeholder=""></textarea>
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
                  <textarea class="form-control remark" rows="3" placeholder="Enter ..." name="remark"></textarea>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="hidden" class="form-control m-input reference_id" style="border: none;" required="true">
            </div>
            <div class="form-group m-form__group" >
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input siteid" style="border: none;" required="true" name="site_id">
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


      $.ajax({
        type: "get",
        url: "{{ URL::to('http://192.168.1.103:8080/rfs/external') }}/" + referenceId,
        success: function(data) {
          console.log(data);
          if (data != null) {

            $(".requested").val(data['user']['name']);
            $(".customer").val(data['account']['name']);
            $(".po_id").val(data['po']['id']);
              $(".site").val(data['address']);
              $(".remark").val(data['remark']);
              $(".siteid").val(0);
        

          }
          $.each(data['products'], function(index, datum) {
            console.log(datum.id);
            $("#data").append('<tr class="qc-tr">' +
              '<td><input type="text" class="form-control m-input" name="product_id[]" value="' + datum['productId'] + '" readonly="true" style="width:75px;border:none;"></td>' +
              '<td>' + datum['mfr'] + '</td>' +
              '<td>' + datum['partName'] + '</td>' +
              '<td>' + datum['partNum'] + '</td>' +
              '<td> <textarea type="text" class="form-control m-input qty_qc">' + datum['partDesc'] + '</textarea></td>' +
              '<td>' + datum['unitMeasure'] + '</td>' +
              '<td><input type="text" name="qty[]" class="form-control m-input qty_qc" style="width: 100px;" value="' + datum['qty'] + '" readonly name="qty[]"></td>' +
              '</tr>');

          });
        }
      });
     

      $(".reference_id").val(referenceId);
      $.ajax({
        type: "get",
        url: " {{ URL::to('/rfs/itemdata') }}/" + referenceId,
        success: function(data) {
          console.log(data);
  
        }
      });



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