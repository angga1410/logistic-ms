<?php

namespace App\Http\Controllers;

use App\PO;
use App\PODetail;
use App\RFS;
use App\RFSDetail;
use App\Site;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;

class RFSController extends Controller
{
    public function create()
    {
        $response = Http::get('https://crm.gspe.ioseries.com/api/external/purchase-orders')->json();
        $data = collect($response);

        $po = PO::all();
        $site = Site::all();
        return view('page/rfs/create')->with('po',$po)->with('site',$site)->with('data',$data);
    }
    public function update($id)
    {
        $response = Http::get('https://crm.gspe.ioseries.com/api/external')->json();
        $data = collect($response);
        $rfs = RFS::find($id);
        $siteid = Site::where('id',$rfs->site_id)->first();
        // dd($siteid->address);
        $site = Site::where('customer_id',$rfs->customer_id)->get();
        $item = RFSDetail::where('rfs_id',$rfs->id)->with("products")->get();
        // dd($item);
        return view('page/rfs/update')->with('rfs',$rfs)->with('site',$site)->with('data',$data)->with('siteid',$siteid)->with('item',$item);
    }
  
    public function createid($id)
    {
        $poid = PO::find($id);
        
        return $poid;
    }
    public function findid($id)
    {
        $poid = RFS::where('id',$id)->with("sites")->first();
        
        return $poid;
    }
    public function itemdata($id)
    {
        $data = RFSDetail::where('rfs_id',$id)->with("products")->get();
        
        return $data;
    }

    public function delete($id)
    {
        $data['status'] = 4;
        RFS::where('id', $id)->update( $data );
        return  redirect( route('list_rfs') )->with('success', 'Delete successfully!');
        
    }


    public function save(Request $request)
    {
        $save = new RFS;
        $date = RFS::orderBy('created_at', 'desc')->first();
        $current_timestamp = date("Y-m-d 00:00:00");
        $num = RFS::where('created_at', $current_timestamp)->count();
        // Parameters
      
        if ($current_timestamp == $date['created_at']) {
            $save->rfs_num_seq = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
           
        } else {
            $save->rfs_num_seq = str_pad(1, 4, "0", STR_PAD_LEFT);
          
        }
        $save->rfs_num = $request->get("rfs_num");
        $save->rfs_date = $request->get("rfs_date");
        $save->document_name = $request->get("document_name");
        $save->po_id = $request->get("po_id");
        $save->customer_id = $request->get("customer_id");
        $save->po_num = $request->get("po_num");
        $save->customer_name = $request->get("customer_name");
        $save->contact_person = $request->get("contact_person");
        $save->contact_hp = $request->get("contact_hp");
        $save->site_id = $request->get("site_id");
        $save->address = $request->get("address");

        $save->requested_by = $request->get("requested_by");
        $save->remark = $request->get("remark");
        $save->created_by = "admin";
        $save->save();

        $product_id = $request->get("product_id");
        $qty = $request->get("qty");
        $qtyblc = $request->get("qtyblc");
        for($i=0;$i<count($product_id);$i++)
        {
            if($product_id[$i] != null && $qty[$i] != null && $qtyblc[$i] != null )
            {$qtybalance = 0;
                $qtybalance = $qtyblc[$i] - $qty[$i];

            $reportDetail = new RFSDetail;
            $reportDetail->rfs_id = $save->id;
            $reportDetail->product_id    = $product_id[$i];
            $reportDetail->qty   	     = $qty[$i];
            $reportDetail->save();

            // $response = Http::put('https://crm.gspe.ioseries.com/api/external/change/balance', [
            //     'poId' => $save->po_id,
            //     'productId' => $product_id[$i],
            //     'balance' =>  $qtybalance,

            // ]);
           

            }
        }
        // $response2 = Http::put('https://crm.gspe.ioseries.com/api/external/change/status', [
        //     'poId' => $save->po_id,
        //     'statusRfs' => 1,
        //     'statusShipping' =>  true,

        // ]);
       

      return  redirect( route('list_rfs') )->with('success', 'Purchase order detail updated successfully!');
    }

    public function saveupdate(Request $request){
        $input = $request->all();
        $id = $request->id;
        $save['rfs_num'] = $request->get("rfs_num");
        $save['rfs_date'] = $request->get("rfs_date");
        $save['po_id'] = $request->get("po_id");
        $save['po_num'] = $request->get("po_num");
        $save['site_id'] = $request->get("site_id");

        $save['requested_by'] = $request->get("requested_by");
        $save['remark'] = $request->get("remark");
       RFS::where('id',$id)->update($save);
       return  redirect( route('list_rfs') )->with('success', 'Purchase order detail updated successfully!');
    }

    public function getData(Request $request)
    {
        // Get Supplier
        
        // $records = RFS::where('status',0)->get();
        $response = Http::get('https://crm.gspe.ioseries.com/rfs/external/')->json();
        $records = collect($response);



        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('rfs_num', function($record) {

                    return $record["rfsNumber"];
                })
                ->editColumn('po_num', function($record) {

                    return $record["poNumber"];
                })
                ->editColumn('rfs_date', function($record) {

                    return $record["rfsDate"];
                })
                ->editColumn('customer_name', function($record) {

                    return $record["accountName"];
                })
                // ->editColumn('site_name', function($record) {
                //     $site = Site::select('name')->where('id',$record->site_id)->first();
                //     if($site == null){
                //         return "Shipping Address";
                //     }
                //     else{return $site->name;}
                    
                // })
                ->editColumn('requested_by', function($record) {

                    return $record["pic"];
                })
            
                ->editColumn('status', function($record) {
if($record["status"] == 'Outstanding'){
                    return '

                       
                   <h5> <span class="badge badge-warning">Outstanding</span></h5>
               
                        

                    ';}else{
                        return '

                       
                        <h5> <span class="badge badge-primary">In-Process</span></h5>
                    
                             
     
                         ';
                    }
                })
              
                ->rawColumns(['id','status'])

            ->make(true);
    }

    public function list()
    {
     
      return view('page/rfs/list');
        
    }

}
