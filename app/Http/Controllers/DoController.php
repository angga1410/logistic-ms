<?php

namespace App\Http\Controllers;

use App\DeliveryOrder;
use App\DODetails;
use App\Forwarder;
use App\PO;
use App\RFS;
use App\Site;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use Auth;

class DoController extends Controller
{
    public function list()
    {
        return view('page/do/list');
    }
    public function listDO()
    {
        $do = DeliveryOrder::with("rfs")->get();
        return $do;
    }
    public function listDODetail($id)
    {
        $do = DODetails::where('do_id',$id)->get();
        return $do;
    }
    public function create()
    {
        $response = Http::get('https://crm.gspe.ioseries.com/rfs/external/')->json();
        $po = collect($response);
   
        $mover = Forwarder::all();
     
        return view('page/do/create')->with('po',$po)->with('mover',$mover);
    }
    public function print($id)
    {
        $response = Http::get('https://crm.gspe.ioseries.com/rfs/external/'.$id)->json();
        
        $po = collect($response);
        // dd($po);
        $do = DeliveryOrder::where('id',$id)->with("sites")->with("mover")->first();
        $do_item = DODetails::where('do_id',$id)->with("products")->get();
        return view('page/do/print')->with('do_item',$do_item)->with('do',$do)->with('po',$po);
    }
    public function mover()
    {
        $mover = Forwarder::all();
        return $mover;
    }
    public function update($id)
    {
        $mover = Forwarder::all();
        $do = DeliveryOrder::where('id',$id)->with("rfs")->with("sites")->with("mover")->first();
        $do_item = DODetails::where('do_id',$id)->with("products")->get();

        return view('page/do/update')->with('do',$do)->with('mover',$mover)->with('do_item',$do_item);
    }

    public function save(Request $request)
    {
        $save = new DeliveryOrder();
        $date = DeliveryOrder::orderBy('created_at', 'desc')->first();
        $current_timestamp = date("Y-m-d 00:00:00");
        $num = DeliveryOrder::where('created_at', $current_timestamp)->count();
        // Parameters
$rfs = $request->get("rfs_id");

      
        if ($current_timestamp == $date->created_at) {
            $save->do_num_seq = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
           
        } else {
            $save->do_num_seq = str_pad(1, 4, "0", STR_PAD_LEFT);
          
        }
        $save->ref_do = $request->get("ref_do");
        $save->po_id = $request->get("po_id");
        $save->pic = $request->get("pic");
        $save->do_num = $request->get("do_num");
        $save->do_date = $request->get("do_date");
        $save->rfs_id = $request->get("rfs_id");
        $save->customer_name = $request->get("customer_name");
        $save->mover_id = $request->get("mover_id");
        $save->site_id = $request->get("site_id");
        $save->remark = $request->get("remark");
        $save->address = $request->get("address");
        $save->requested_by = $request->get("requested_by");
        $save->created_by = "admin";
        $save->save();

        $product_id = $request->get("product_id");
     
        $qty = $request->get("qty");

        for($i=0;$i<count($product_id);$i++)
        {
            if($product_id[$i] != null && $qty[$i] != null )
            {

            $reportDetail = new DODetails();
            $reportDetail->do_id = $save->id;
            $reportDetail->product_id    = $product_id[$i];
            $reportDetail->qty   	     = $qty[$i];
            $reportDetail->balance_qty   	     = $qty[$i];
            $reportDetail->save();

            }
        }
        $response = Http::get('https://crm.gspe.ioseries.com/rfs/update?id='.$rfs.'&status=1')->json();

      return  redirect( route('list_do') )->with('success', 'Purchase order detail updated successfully!');
    }
    public function saveupdate(Request $request){
        $input = $request->all();
        $id = $request->id;
        $save['ref_do'] = $request->get("ref_do");
        $save['pic'] = $request->get("pic");
        $save['do_date'] = $request->get("do_date");
        $save['mover_id'] = $request->get("mover_id");
        $save['requested_by'] = $request->get("requested_by");
        $save['remark'] = $request->get("remark");
       DeliveryOrder::where('id',$id)->update($save);
       return  redirect( route('list_do') )->with('success', 'Purchase order detail updated successfully!');
    }
 

    public function getData(Request $request)
    {
        // Get Supplier
        
        $records = DeliveryOrder::where('status','!=',5)->get();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('do_num', function($record) {

                    return $record->do_num.''.$record->do_num_seq;
                })
               
                ->editColumn('do_date', function($record) {

                    return $record->do_date;
                })
                ->editColumn('ref_do', function($record) {

                    return $record->ref_do;
                })
                ->editColumn('costumer_name', function($record) {

                    return $record->customer_name;
                })
                ->editColumn('site', function($record) {
                    $site = Site::select('name')->where('id',$record->site_id)->first();
                    if($site == null){
                        return "Shipping Address";
                    }
                    else{return $site->name;}
                    
                })
                ->editColumn('mover', function($record) {
                    $site = Forwarder::select('name')->where('id',$record->mover_id)->first();
                    if($site == null){
                        return "External";
                    }
                    else{return $site->name;}
                })
                ->editColumn('remark', function($record) {

                    return $record->remark;
                })
                ->editColumn('pic', function($record) {

                    return $record->pic;
                })
                ->editColumn('requested_by', function($record) {

                    return $record->requested_by;
                })
                ->editColumn('status', function($record) {
                    if($record->status == 0){
                                        return '
                    
                                           
                                       <h5> <span class="badge badge-secondary">Outstanding</span></h5>
                                   
                                            
                    
                                        ';}elseif($record->status == 1){
                                            return '
                    
                                           
                                            <h5> <span class="badge badge-warning">In-Process</span></h5>
                                        
                                                 
                         
                                             ';
                                        }elseif($record->status == 2){
                                            return '
                    
                                           
                                            <h5> <span class="badge badge-primary">In-Transit</span></h5>
                                        
                                                 
                         
                                             ';
                                        }elseif($record->status == 3){
                                            return '
                    
                                           
                                            <h5> <span class="badge badge-success">Delivered</span></h5>
                                        
                                                 
                         
                                             ';
                                        }
                                        elseif($record->status == 4){
                                            return '
                    
                                           
                                            <h5> <span class="badge badge-danger">Problem</span></h5>
                                        
                                                 
                         
                                             ';
                                        }
                                    })
                ->editColumn('action', function($record) {
                     if($record->status == 1){

                    return '&nbsp&nbsp

                        <a href="'.route('update_do', $record->id).'"">
                        <i class="fas fa-edit "></i>
                        </a>

                        &nbsp&nbsp

                       
                          <a href="'.route('print_do', $record->id).'" ">
                          <i class="fas fa-print danger"></i>
                      </a>

                   ';}elseif($record->status == 0){
                          

                    return '&nbsp&nbsp

                    <a href="'.route('update_do', $record->id).'"">
                    <i class="fas fa-edit "></i>
                    </a>

                    &nbsp&nbsp

                   
                      <a href="'.route('print_do', $record->id).'" ">
                      <i class="fas fa-print danger"></i>
                  </a>

                    ';
                      }
                      elseif($record->status == 2){
                          

                        return '&nbsp&nbsp
    
                        <a href="'.route('update_do', $record->id).'"">
                        <i class="fas fa-edit "></i>
                        </a>
    
                        &nbsp&nbsp
    
                       
                          <a href="'.route('print_do', $record->id).'" ">
                          <i class="fas fa-print danger"></i>
                      </a>
    
                      &nbsp&nbsp
                      <a style="color:#1bd365;" title="Update Status DO" onclick="updateStatus('.$record->id.')">
           
                      <i  class="fas fa-clipboard-check"></i>
                  </a>';
                          }
                          elseif($record->status == 3){
                          

                            return '&nbsp&nbsp
        
                            <a href="'.route('update_do', $record->id).'"">
                            <i class="fas fa-edit "></i>
                            </a>
        
                            &nbsp&nbsp
        
                           
                              <a href="'.route('print_do', $record->id).'" ">
                              <i class="fas fa-print danger"></i>
                          </a>
        
                            ';
                              }
                              elseif($record->status == 4){
                          

                                return '&nbsp&nbsp

                                <a href="'.route('update_do', $record->id).'"">
                                <i class="fas fa-edit "></i>
                                </a>
        
                                &nbsp&nbsp
        
                               
                                  <a href="'.route('print_do', $record->id).'" ">
                                  <i class="fas fa-print danger"></i>
                              </a>
                           
        
                              &nbsp&nbsp
                                  <a style="color:#FF0000;" title="Update Status DO" onclick="updateStatus2('.$record->id.')">
                       
                                  <i  class="fa fa-exclamation-triangle"></i>
                              </a>';
                                  }
                })
              
                ->rawColumns(['id','action','status'])

            ->make(true);
    }

    public function getDataApi(Request $request)
    {
        // Get Supplier
        $ldate = date('Y-m-d');
        $records = DeliveryOrder::where('status',0)->where('do_date',$ldate)->get();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('do_num', function($record) {

                    return $record->do_num;
                })
                ->editColumn('do_num_seq', function($record) {

                    return $record->do_num_seq;
                })
                
                ->editColumn('costumer_name', function($record) {

                    return $record->customer_name;
                })
                
           
                ->editColumn('remark', function($record) {

                    return $record->remark;
                })
       
              
                ->rawColumns(['id','action'])

            ->make(true);
    }

    public function doUpdate($id)
    {
        $poDetail['status'] = 1;

        DeliveryOrder::where('id', $id)->update($poDetail);
    }

    public function listDOAPI($id)
    {
        $do = DeliveryOrder::where('po_id',$id)->select('do_num','do_num_seq','ref_do','id')->get();
        return $do;
    }


    public function listDODetailAPI($id)
    {
        $do = DeliveryOrder::where('id',$id)->with(array('details.products' => function ($query) {
			$query->select('id', 'mfr', 'part_name', 'part_num', 'part_desc');
		}))->first();
        return $do;
    }

    public function doDetailAPI($id)
    {
        $data = DeliveryOrder::where('id',$id)->first();
        return $data;
    }

    public function updateDoStatus(Request $request)
    {

            if($request->get("status") == 0){
                    $dataDO = DeliveryOrder::where('id',$request->get("do_id"))->first();
                    $save = new DeliveryOrder();
                    $date = DeliveryOrder::orderBy('created_at', 'desc')->first();
                    $current_timestamp = date("Y-m-d 00:00:00");
                    $num = DeliveryOrder::where('created_at', $current_timestamp)->count();
                    // Parameters
            $rfs = $dataDO->rfs_id;
            
                  
                    if ($current_timestamp == $date->created_at) {
                        $save->do_num_seq = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
                       
                    } else {
                        $save->do_num_seq = str_pad(1, 4, "0", STR_PAD_LEFT);
                      
                    }
                    $save->ref_do = $dataDO->ref_do;
                    $save->po_id = $dataDO->po_id;
                    $save->pic = $dataDO->pic;
                    $save->do_num =$dataDO->do_num;
                    $save->do_date = $current_timestamp;
                    $save->rfs_id = $dataDO->rfs_id;
                    $save->customer_name = $dataDO->customer_name;
                    $save->mover_id = $dataDO->mover_id;
                    $save->site_id = $dataDO->site_id;
                    $save->remark = $dataDO->remark;
                    $save->address = $dataDO->address;
                    $save->requested_by = $dataDO->requested_by;
                    $save->recreate_from = $dataDO->id;
                    $save->created_by = "admin";
                    $save->save();

                    $detail = DODetails::where('do_id',$dataDO->id)->get();
                   foreach($detail as $get)
                    {
                       
            
                        $reportDetail = new DODetails();
                        $reportDetail->do_id = $save->id;
                        $reportDetail->product_id    = $get->product_id;
                        $reportDetail->qty   	     = $get->qty;
                        $reportDetail->balance_qty   	     = $get->qty;
                        $reportDetail->save();
            
                      
                    }

                    $response = Http::get('https://crm.gspe.ioseries.com/rfs/external/'.$save->id)->json();
        
        $po = collect($response);
        // dd($po);
        $do = DeliveryOrder::where('id',$save->id)->with("sites")->with("mover")->first();
        $do_item = DODetails::where('do_id',$save->id)->with("products")->get();
        // dd($do_item);
        return view('page/do/print')->with('do_item',$do_item)->with('do',$do)->with('po',$po);

        
            }else{
                $update['status'] = $request->get("status");
                $update['delivery_date'] = date('Y-m-d H:i:s');
                $update['status_remark'] = $request->get("status_remark");
                    DeliveryOrder::where('id',$request->get("do_id"))->update($update);
                    return  redirect( route('list_do') )->with('success', 'Purchase order detail updated successfully!');
        
            }
    }

}
