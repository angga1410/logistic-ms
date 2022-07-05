<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use App\Site;

class SiteController extends Controller
{
    public function create()
    {
        $response = Http::get('https://crm.gspe.ioseries.com/accounts/dropdown/all?id=1&role=Admin')->json();
        $data = collect($response);
      return view('page/site/create')->with('response',$data);
        
    }

    public function save(Request $request){
        $save = new Site;
        $save->name = $request->get("name");
        $save->site_name = $request->get("site_name");
        $save->address = $request->get("address");
        $save->customer_id = $request->get("customer_id");
        $save->save();
    }

    public function list()
    {
     
      return view('page/site/list');
        
    }
    public function listrfs()
    {
     
      return view('page/rfs/list');
        
    }
    public function getData(Request $request)
    {
        // Get Supplier
        
        $records = Site::all();


        return Datatables::of($records)
        ->editColumn('null', function($record) {

            return;
        })
                ->editColumn('site_name', function($record) {

                    return $record->site_name;
                })
                ->editColumn('name', function($record) {

                    return $record->name;
                })->editColumn('address', function($record) {

                    return $record->address;
                })
               
              
                ->rawColumns(['id'])

            ->make(true);
    }

    public function datasite($id){
        $datasite = Site::where('customer_id',$id)->get();
        return $datasite;
    }

}
