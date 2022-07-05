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
        <h4><i class="fas fa-file-import"></i> &nbsp&nbsp Entry New Request for Shipment </h4>

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
      <form method="post" action="{{url('/rfs/save')}}">
      {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>RFS #</label>
              <input type="text" class="form-control" data-date-start-date="d" value="RFS/{{date('Y/m/d', strtotime('0 day'))}}/" readonly name="rfs_num">
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
                <input type="date" class="form-control float-right" id="" name="rfs_date" required>
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
                <option>Internal</option>
                <option>External</option>
                <!-- <option>Demo Product</option> -->
              </select>
            </div>
            <div class="form-group">
              <label>Request By:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                </div>
                <input type="text" class="form-control" name="requested_by" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form-group -->
            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input reference_id" name="po_id" style="border: none;" required="true">
            </div>
            <div class="form-group m-form__group" hidden >
             
              <input type="text" class="form-control m-input customer_id" name="customer_id" style="border: none;" required="true">
            </div>
            <div class="form-group m-form__group" hidden >
             
             <input type="text" class="form-control m-input refsite" id="refsite" name="address" style="border: none;" required="true">
           </div>

           <div class="form-group m-form__group" hidden >
             
             <input type="text" class="form-control m-input document_name" id="document_name" name="document_name" style="border: none;" required="true">
           </div>
          
            <!-- /.form group -->

            <!-- IP mask -->
            <div class="form-group">
              <label>Send To:</label>

              <div class="input-group">

                <select class="form-control select2 site" style="width: 100%;" name="site_id" required>
              
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Address :</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <textarea class="form-control address" rows="2" placeholder=""  disabled></textarea>
              </div>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Reference Number</label>
              <div class="input-group">

                <select class="form-control select2 document_no" style="width: 100%;" name="po_num">
                  <option>Select PO#</option>
                  @foreach ($data as $po_nums)
                  <option value="{{$po_nums['id']}}" data="{{$po_nums['id']}}">{{$po_nums['purchaseOrderNumber']}}</option>
                  @endforeach
                </select>
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

                <input type="text" class="form-control float-right customer" id="" name="customer_name" readonly>
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

                <input type="text" class="form-control float-right contact_person" name="contact_person" readonly>
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
                <input type="text" class="form-control float-right contact_hp" id="" name="contact_hp" readonly>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Note :</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <textarea class="form-control" rows="2" placeholder="" name="remark" required></textarea>
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
                    <th>Action</th>
                  </tr>
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
  var datashipping;
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
      $('.site').empty().append('<option value="0"  data="0">Shipping Address</option>');
      $('.address').val('');
      var referenceId = $(this).find('option:selected').attr('data');
      var type = $(this).find('option:selected').attr('type');
      $(".reference_id").val(referenceId);

      $.ajax({
        type: "get",
        url: "http://192.168.0.106:8080/po/detail/" + referenceId,
        success: function(data) {
          console.log(data);
          if (data != null) {
            // $(".ref_site").val(data.account.name);
            $(".contact_person").val(data.contact.name);
            $(".contact_hp").val(data.contact.phoneMobile);
            $(".address").val(data.account.shippingAddress);
            $(".refsite").val(data.account.shippingAddress);
            $(".customer").val(data.account.name);
            $(".customer_id").val(data.account.id);
            $(".document_name").val(data.name);
            


            $.ajax({
        type:"get",
        url: "{{ URL::to('/site/datasite') }}/"+data.account.id,
        success: function(data) { 
          console.log(data);
        	$.each(data, function (index, datum) {
	    		$('.site').append('<option data="'+datum.address+'" value="'+datum.id+'">'+datum.name+'</option>');
	        });
        }
      });

      

          }
        }
      });
     
      $.ajax({
        type: "get",
        url: "http://192.168.0.106:8080/po/detail/" + referenceId,
        success: function(data) {
          $.each(data.products, function(index, datum) {
            console.log("test",datum.productId);
            $("#data").append('<tr class="qc-tr">' +
            '<input type="hidden" class="form-control m-input" name="qtyblc[]" value="' + datum.qty1 + '" readonly="true">' +
              '<td><input type="text" class="form-control m-input" name="product_id[]" value="' + datum.productId + '" readonly="true" style="width:75px;border:none;"></td>' +
              '<td>' + datum.mfr + '</td>' +
              '<td>' + datum.part_name + '</td>' +
              '<td>' + datum.part_num + '</td>' +
              '<td> <textarea type="text" class="form-control m-input qty_qc">' + datum.part_desc +'</textarea></td>' +
              '<td>' + datum.default_um + '</td>' +
              '<td><input type="text" name="qty[]" class="form-control m-input qty_qc" style="width: 100px;" value="' + datum.qty1 + '" ></td>' +
              '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="far fa-trash-alt"></i></a></td>' +
              '</tr>');

          });
        }
      });

      

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