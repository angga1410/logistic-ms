<?php

namespace App\Http\Controllers;

use App\DeliveryOrder;
use App\Forwarder;
use App\Site;
use App\SPK;
use App\SPKDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;

class SPKController extends Controller
{
    public function list()
    {
        
        return view('page/spk/list');
    }
    public function spk($id)
     {  // $spkDetail = SPKDetail::where('spk_id',$id)->with("do")->with("rfs")->with("site")->get();
        $spk = SPK::where('id',$id)->first();
        $spkDetail = SPKDetail::where('spk_id',$id)->with("do")->with("site")->get();
        return view('page/spk/spk')->with('spk',$spk)->with('spkDetail',$spkDetail);
    }
    public function create()
    {
        return view('page/spk/create');
    }
    public function update($id)
    {   $mover = Forwarder::all();
        $spk = SPK::find($id);
        $spkDetail = SPKDetail::where('spk_id',$id)->with("do")->with("site")->get();
        return view('page/spk/update')->with('spk',$spk)->with('spkDetail',$spkDetail)->with('mover',$mover); 
      
    }
    public function deleteItem($id){
        SPKDetail::where('id',$id)->delete();
        return back();
    }
    public function addItem(Request $request){
        $save = new SPKDetail();
        $save->spk_id = $request->get("spk_id");
        $save->do_id = $request->get("do_id");
        $save->address = $request->get("address");
        $save->send_to = $request->get("send_to");
        $save->remark = $request->get("remark");
        $save->save();
    }

    public function save(Request $request)
    {
        $save = new SPK();

        $date = SPK::orderBy('created_at', 'desc')->first();
        $current_timestamp = date("Y-m-d 00:00:00");
        $num = SPK::where('created_at', $current_timestamp)->count();
        // Parameters


      
        if ($current_timestamp == $date->created_at) {
            $save->spk_num_seq = str_pad($num + 1, 4, "0", STR_PAD_LEFT);
           
        } else {
            $save->spk_num_seq = str_pad(1, 4, "0", STR_PAD_LEFT);
          
        }
        $save->spk_num = $request->get("spk_num");
        $save->spk_date = $request->get("spk_date");
        $save->mover_type = $request->get("mover_type");
        $save->mover_name = $request->get("mover_name");
        $save->mover_phone = $request->get("mover_phone");
        $save->contact_person = $request->get("contact_person");
        $save->contact_phone = $request->get("contact_phone");
        $save->weight = $request->get("weight");
        $save->dimentions = $request->get("dimentions");
        $save->price = $request->get("price");
        $save->created_by = Auth::User()->id;
        $save->save();

        $product_id = $request->get("do_id");
     
        $remark = $request->get("remark");
        $rfs_id = $request->get("send_to");
        $site_id = $request->get("address");

        for($i=0;$i<count($product_id);$i++)
        {
            if($product_id[$i] != null && $remark[$i] != null )
            {

            $reportDetail = new SPKDetail();
            $reportDetail->spk_id = $save->id;
            $reportDetail->do_id    = $product_id[$i];
            $reportDetail->address    = $site_id[$i];
            $reportDetail->send_to    = $rfs_id[$i];
            $reportDetail->remark   	     = $remark[$i];
            $reportDetail->save();

            $update['status'] = 1;
            DeliveryOrder::where('id',$product_id[$i])->update($update);

            }
        }


      return  redirect( route('list_spk') )->with('success', 'SPK Created successfully!');
    }

    public function saveupdate(Request $request){
        $input = $request->all();
        $id = $request->get("id");
        $save['spk_date'] = $request->get("spk_date");
        $save['mover_type'] = $request->get("mover_type");
        $save['mover_name'] = $request->get("mover_name");
        $save['mover_phone'] = $request->get("mover_phone");
        $save['contact_person'] = $request->get("contact_person");
        $save['contact_phone'] = $request->get("contact_phone");
        $save['weight'] = $request->get("weight");
        $save['dimentions'] = $request->get("dimentions");
        $save['price'] = $request->get("price");
        SPK::where('id',$id)->update($save);
        $remark = $request->get("remark");
        $detail = $request->get("detail_id");

        for($i=0;$i<count($remark);$i++)
        {
            if( $remark[$i] != null && $detail[$i] != null )
            {
            $reportDetail['remark']  = $remark[$i];
           SPKDetail::where('id',$detail[$i])->update($reportDetail);

            }
        }
      
       return  redirect( route('list_spk') )->with('success', 'Purchase order detail updated successfully!');
    }
    public function doData(Request $request)
	{
		$term = $request->get('term');

        $data = DeliveryOrder::where('do_num', 'LIKE', '%'.$term.'%')->orWhere('customer_name', 'LIKE', '%'.$term.'%')->with("sites")->get();

        $results = array();

        foreach ($data as $query)
        {
        
                $results[] = ['id' => $query->id ,'do_num' => $query->do_num,'do_num_seq' => $query->do_num_seq, 'customer_name' => $query->customer_name , 'send_to' => $query->customer_name ,'address' => $query->rfs->address ,'remark' => $query->remark ];
         

        }
        return response()->json($results);
    }
    
    public function getData(Request $request)
    {
        // Get Supplier
        
        $records = SPK::where('status',0)->get();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('spk_num', function($record) {

                    return $record->spk_num;
                })
               
                ->editColumn('spk_date', function($record) {

                    return $record->spk_date;
                })
                ->editColumn('mover_type', function($record) {

                    return $record->mover_type;
                })
              
                ->editColumn('mover_name', function($record) {
                   
                    return $record->mover_name;
                })
                ->editColumn('mover_phone', function($record) {
                   
                    return $record->mover_phone;
                })
                ->editColumn('contact_person', function($record) {

                    return $record->contact_person;
                })
                ->editColumn('contact_phone', function($record) {

                    return $record->contact_phone;
                })
                ->editColumn('action', function($record) {

                    return '

                        &nbsp&nbsp

                        <a href="'.route('update_spk', $record->id).'"">
                        <i class="fas fa-edit "></i>
                        </a>

                      

                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <a href="'.route('spk', $record->id).'"">
                          <i class="fas fa-print"></i>
                          </a>
  
                        
  
                            &nbsp&nbsp&nbsp&nbsp&nbsp

                       
                          <a href="'.route('delete_rfs', $record->id).'" OnClick="return confirm(\' Are you sure to delete it \');"">
                          <i class="fas fa-trash-alt danger"></i>
                      </a>
                        

                    ';
                })
              
                ->rawColumns(['id','action'])

            ->make(true);
    }
    public function getDataSPK($id)
    {
        // Get Supplier
        
        $records = SPKDetail::where('spk_id',$id)->get();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('spk_num', function($record) {

                    return $record->spk_num;
                })
               
                ->editColumn('spk_date', function($record) {

                    return $record->spk_date;
                })
                ->editColumn('mover_type', function($record) {

                    return $record->mover_type;
                })
              
                ->editColumn('mover_name', function($record) {
                   
                    return $record->mover_name;
                })
                ->editColumn('mover_phone', function($record) {
                   
                    return $record->mover_phone;
                })
                ->editColumn('contact_person', function($record) {

                    return $record->contact_person;
                })
                ->editColumn('contact_phone', function($record) {

                    return $record->contact_phone;
                })
                ->editColumn('action', function($record) {

                    return '

                        &nbsp&nbsp

                        <a href="'.route('update_spk', $record->id).'"">
                        <i class="fas fa-edit "></i>
                        </a>

                      

                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <a href="'.route('spk', $record->id).'"">
                          <i class="fas fa-print"></i>
                          </a>
  
                        
  
                            &nbsp&nbsp&nbsp&nbsp&nbsp

                       
                          <a href="'.route('delete_rfs', $record->id).'" OnClick="return confirm(\' Are you sure to delete it \');"">
                          <i class="fas fa-trash-alt danger"></i>
                      </a>
                        

                    ';
                })
              
                ->rawColumns(['id','action'])

            ->make(true);
    }

    public function getItemSPK($id)
    {
        // Get Supplier
        
        $records = SPKDetail::where('spk_id',$id)->with("do")->get();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
        ->editColumn('spk_id', function($record) {

            return '<input type="hidden" class="form-control m-input" name="detail_id[]" value="'. $record->id.'" style="width:50px;border:none;"readonly="true">'
            ;
        })
        ->editColumn('id', function($record) {

            return '<input type="text" class="form-control m-input" name="do_id[]" value="'. $record->do->id.'" style="width:50px;border:none;"readonly="true">'
            ;
        })
                ->editColumn('do', function($record) {

                    return $record->do->do_num;
                })
               
                ->editColumn('customer', function($record) {

                    return $record->do->customer_name;
                })
                ->editColumn('send_to', function($record) {

                    return $record->send_to;
                })
              
                ->editColumn('address', function($record) {
                   
                    return '<textarea  type="text" class="form-control m-input qty_qc">'.$record->address.'</textarea>' 
                    ;
                })
                ->editColumn('remark', function($record) {
                   
                    return '<textarea  type="text" class="form-control m-input qty_qc">'.$record->remark.'</textarea>' ;
                })
                ->editColumn('action', function($record) {

                    return '

                    <a  href="'.route('delete_item_spk', $record->id).'" class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="far fa-trash-alt"></i></a>

                    ';
                })
              
                ->rawColumns(['spk_id','id','action','address','remark'])

            ->make(true);
    }

    
}
