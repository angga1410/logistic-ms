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
        <h4><i class="fas fa-truck"></i> &nbsp&nbsp Delivery Order </h4>

        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <a href="" class="btn btn-secondary m-btn m-btn--air m-btn--custom" onclick="printDiv('printableArea')">PRINT</a>
<div id="printableArea">
      <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-sm-8">
                        <img src="{{asset('img/logorr.png')}}" alt="AdminLTE Logo"  style="opacity: 1.8; width:50%;">
                            <p class="mb-1"><span class="text-muted">PT. GRAHA SUMBER PRIMA ELEKTRONIK </span></p>
                            <p class="mb-1"><span class="text-muted">INTERCON PLAZA BLOK D11 </span></p>
                            <p class="mb-1"><span class="text-muted">JL. MERUYA ILIR, SRENGSENG-KEMBANGAN</p>
                            <p class="mb-1"><span class="text-muted">Phone  (62-21)7587-9949/51 </span></p>
                            <!-- <p class="mb-1"><span class="text-muted"> NPWP : 01.789.513.038.000  </span></p> -->
                        </div>

                        <div class="col-sm-4">
                      
                            <p class="font-weight-bold mb-1" value=""  onchange="location = this.value;"></p>
                           
                            <p class="text-muted">{{ date("Y-m-d H:i:s")}}</p>
                            <p class="font-weight-bold mb-1"><h2>Delivery Order</h2>  </p>
                            <table style="width:100%">
  <tr>
    <th>DO#.</th>
    <td><b>{{$do->do_num}}{{$do->do_num_seq}}</b></td>
  </tr>
  <tr>
  <th>Do Date.</th>
    <td>{{$do->do_date}}</td>
  </tr>

  <tr>
  <th>Source</th>
    <td>{{$po["rfsNumber"]}}</td>
    
  </tr>

  <tr>
  <th>PO Customer</th>
   
    <td>{{$po["po"]["poNumber"]}}</td>
  </tr>
 
</table>
                        </div>
                        
                    </div>

                    <hr class="my-5">

                   
                    <div class="row pb-5 p-5">
                                <div class="col-md-6">
                                    <p class="font-weight-bold mb-4">CUSTOMER NAME</p>
                                  <b>{{$po["account"]["name"]}}</b>
                                  <p class="mb-1"><span class="text-muted">{{$po["contact"]["name"]}} - {{$po["contact"]["phone"]}}</span></p>
                                   

                                
                                </div>
                               
                                <div class="col-md-6 text-right">
                                    <p class="font-weight-bold mb-4">SHIP TO</p>
                                    @if ($do->site_id == 0)
                                    <p class="mb-1"><span class="text-muted">{{$po["address"]}}</span></p>
                                    <p class="mb-1"><span class="text-muted"> {{$po["account"]["phone"]}}</span></p>
                                   
                
                  @else
                 
                  <p class="mb-1"><span class="text-muted">{{$do->sites->address}}</span></p>
                  @endif
                                    <!-- <p class="mb-1"><span class="text-muted">PT. GRAHA SUMBER PRIMA ELEKTRONIK </span></p>
                                    <p class="mb-1"><span class="text-muted">KAWASAN INDUSTRI TAMAN TEKNO KAV. C11-12 </span></p>
                                    <p class="mb-1"><span class="text-muted">BSD, TANGERANG SELATAN 15314</span></p>
                                    <p class="mb-1"><span class="text-muted">Phone (62-21)7587-9952 </span></p> -->

                                </div>
                            </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                        <div class="row" id="m_user_profile_tab_1">

                        <table  class="table table-bordered m-table"  style="width:100%" > 
							<thead>
						        <tr>
						          <th class="first">Mfr.</th>
						          <th class="first">Part Number</th>
						          <th class="second">Part Name</th>
						          <th class="third">Description</th>
                                  <th class="eighth">U/M</th>
                                  <th class="eighth">PO Qty</th>
                                  <th class="eighth">Delivery Qty</th>
                                 
                                 
						        </tr>
						    </thead>
						    <tbody>
						   
						      
                            @foreach($do_item as $items)
                  <tr>
                  
                 
                    <td>{{$items->products->mfr}}</td>
                    <td>{{$items->products->part_name}}</td>
                    <td>{{$items->products->part_num}}</td>
                    <td>{{$items->products->part_desc}}</td>
                    <td>{{$items->products->default_um}}</td>
                    <td> {{$items->qty}}</td>
                    <td> {{$items->qty}}</td>
                   
                  </tr>
                  @endforeach
                            
						    </tbody>
					       </table>
</div>
                        </div>
                    </div>

                  
                    <div class="col-md-6">
                    <p class="mb-1"><span class="text-muted">Remark : {{$do->remark}}</span></p>
                  
                    <p class="mb-1"><span class="text-muted">Note :</span></p>
                            <p class="mb-1"><span class="text-muted">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                           
                        </div>
                        <br>
                       
                        <div class="row">
    <div class="col-sm">
    <p class="text-center">  PREPARED BY : 
    </div>
    <div class="col-sm">
    <p class="text-center">  APPROVED BY : 
    </div>
    <div class="col-sm">
    <p class="text-center">  CUSTOMER : 
    </div>
  </div>
  <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                </div>
            </div>
        </div>
    </div>
    
   

</div>
</div>
         
   
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
function printDiv(divName) {
  
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
}


</script>
@endsection