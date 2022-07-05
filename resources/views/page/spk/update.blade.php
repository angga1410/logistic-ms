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
        <h4><i class="fas fa-file-import"></i> &nbsp&nbsp Entry SPK </h4>

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
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="card-body">
      <form method="post" action="{{url('/spk/saveupdate')}}">
      {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>SPK #</label>
              <input type="text" class="form-control float-right" name="spk_num" value="{{$spk->spk_num}}" disabled>
            </div>
            <!-- /.form-group -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>SPK Date </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="date" class="form-control float-right" name="spk_date" value="{{$spk->spk_date}}">
              </div>
            </div>
            <!-- /.form-group -->

          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-md-6">

            <!-- /.form-group -->
            <div class="form-group">
              <label>Mover Type:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-truck"></i></span>
                </div>
                <select class="form-control select2 type" required name="mover_type">
                  <option></option>
                  @if ($spk->mover_type == "Internal")
                  <option data="1" selected >Internal</option>
                  <option data="0" >External</option>
@else
                  <option data="0" selected>External</option>
                  <option data="1"  >Internal</option>
                  @endif

                </select>
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group m-form__group" hidden >
            
              <input type="text" class="form-control m-input" id="id" name="id" style="border: none;" required="true" value="{{$spk->id}}">
            </div>
         
            <!-- /.form group -->

            <!-- IP mask -->
            <div class="form-group">
              <label>Mover Name:</label>

              <div class="input-group movername">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-user-friends"></i></span>
                </div>
                @if ($spk->mover_type == "Internal")
               
                <select class="form-control mover select2" name="mover_name" style="width: 93%;"required>
                @foreach($mover as $movers)
                @if ($movers->name == $spk->mover_name)
                <option value="{{ $movers->name }}" data="{{$movers->contact}}" selected=""> {{ $movers->name }}</option>
                @else
                <option value="{{ $movers->name }}" data="{{$movers->contact}}"> {{ $movers->name }}</option>
                @endif
                @endforeach
                </select>
               

                @else
                <input type="text" class="form-control float-right" name="mover_name" value="{{$spk->mover_name}}">
@endif
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Mover Phone:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right contact" name="mover_phone" value="{{$spk->mover_phone}}">
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Dimentions:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-ruler-combined"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" name="dimentions" value="{{$spk->dimentions}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Contact Person:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-user-friends"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" name="contact_person" value="{{$spk->contact_person}}" >
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Contact Phone:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </div>
                <input type="text" class="form-control float-right" name="contact_phone" value="{{$spk->contact_phone}}" >
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Weight:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-weight-hanging"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" name="weight" value="{{$spk->weight}}">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->

            <!-- Date and time range -->
            <div class="form-group">
              <label>Price:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-tags"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" name="price" value="{{$spk->price}}">
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <!-- /.col -->
        </div>



        <!-- /.row -->

        <!-- /.row -->

        <!-- /.row -->
     

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <label>Add DO#</label>
              <div class="input-group">
              <input type="text" class="form-control float-right" id="searchProduct" style="width:350px;">
		

                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fas fa-plus-circle"></i></div>
                </div>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" >
              <table class="table table-head-fixed text-nowrap" id="do_num">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>DO#</th>
                    <th>Customer#</th>
                    <th>Send To</th>
                    <th>Address</th>
                    <th>Remark</th>
                    <th>Action</th>
                  </tr>
                </thead>
              

              </table>
           
            </div>
            <div class="card-footer">
             
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        <!-- /.card -->
      </div>
      <button type="submit" class="btn btn-info btn-lg">Submit</button>
              <button type="submit" class="btn btn-default btn-lg float-right">Cancel</button>
     
      </form>       </div>
    </div>
 
    <!-- /.container-fluid -->
</section>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>

   $(function () {
    bla = $('#id').val();
    console.log(bla);
    $('#do_num').DataTable({
      responsive: true,
      autoWidth: false,
      paging: false,
               processing: true,
               serverSide: true,
               searching: false,
               info:false,
               ajax: "{{ URL::to('spk/getitemspk') }}/"+bla,
               columns: [  
                  {data :'id', name: ''},
                        { data: 'do', name: 'do' },
                        { data: 'customer', name: 'customer' },
                        { data: 'send_to', name: 'send_to' },
                        { data: 'address', name: 'address' },
                        { data: 'remark', name: 'remark' },
                        { data: 'action', name: 'action' },
                        {data :'spk_id', name: 'id'},
                      

                     ]
                    
            });
           
  });

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


  })
  $(function() {
  $(".mover").on("change", function() {
          $('.contact').val('');
          var referenceId = $(this).find('option:selected').attr('data');
          $(".contact").val(referenceId);
        });
      })

  $(function() {

    $(".type").on("change", function() {
      $('.movername').val('');
      $('.contact').val('');
      var type = $(this).find('option:selected').attr('data');


      if (type != 0) {
        $(function() {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })


        })
        $('.movername').empty().append('<select class="form-control mover select2" name="mover_name"></select>');
        $.ajax({
          type: "get",
          url: "{{ URL::to('/do/mover') }}",
          success: function(data) {
            console.log(data);
            $.each(data, function(index, datum) {
              $('.mover').append('<option value="' + datum.name + '"data="' + datum.contact + '" >' + datum.name + '</option>');
            });
          }
        });
        $(".mover").on("change", function() {
          $('.contact').val('');
          var referenceId = $(this).find('option:selected').attr('data');
          $(".contact").val(referenceId);
        });
      } else {
        $('.movername').empty().append('<input type="text" class="form-control" name="mover_name">');
      }

    });

  });









  $(function(){
 var engine = new Bloodhound({
            remote:{

               

				url: "{{ URL::to('/spk/dodata?term=%QUERY%') }}",
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct").typeahead({
            hint: true,
            highlight: true,
            minLength:1
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'do_num',
                 limit:7,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<div class="bg-light"  style="cursor: pointer; padding-top:2em"><li id="suggestion">' + data.do_num +' - '+data.customer_name +'</li></div></br>'
                                }

                }

         });
        $('#searchProduct').on('typeahead:selected', function (e, datum) {
          bla = $('#id').val();
       $.ajax({
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
      type: 'POST',
      url: "{{ URL::to('/spk/additem') }}",
      data:  { spk_id: bla ,
        do_id: datum.id,
        address: datum.address ,
        send_to: datum.send_to ,
        remark: datum.id ,
       },
     
      
});
          $("#searchProduct").val('');
          console.log("test",datum.rfs_id);
            // $("#btn_qc").show();
            $("#do_num").append('<tr>'+
                '<input type="hidden" class="form-control m-input" name="send_to[]" value="'+datum.send_to+'">'+
                '<input type="hidden" class="form-control m-input" name="address[]" value="'+datum.address+'">'+
                '<td><input type="text" class="form-control m-input" name="do_id[]" value="'+datum.id+'" style="width:50px;border:none;"readonly="true"></td>'+
                '<td>'+datum.do_num+'</td>'+
                '<td>'+datum.customer_name+'</td>'+
                '<td>'+datum.send_to+'</td>'+
                '<td><textarea  type="text" class="form-control m-input qty_qc">'+datum.address+'</textarea></td>'+
                '<td><textarea  type="text" class="form-control m-input" name="remark[]"></textarea></td>'+
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="far fa-trash-alt"></i></a></td>' +
                '</tr>');
            
        });
 
});
$('#do_num').on('click', '.deleteItem', function() {
    $(this).closest('tr').remove();
  });

 
</script>
@endsection