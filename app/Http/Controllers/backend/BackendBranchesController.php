<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB; 
use Validator; 
use Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Gate;
class BackendBranchesController extends Controller
{
    public function index(Request $request){

        if($request->ajax())
        {
            $data = Branch::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="category_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('branchname', function($data) {
                      $name = Str::title($data->name);
                      return  $name ;

                    }) 
                    ->addColumn('branchsku', function($data) {
                      $sku = $data->sku;
                      return  $sku ;

                    })  
                    ->addColumn('branchimage', function($data) {
                       $img = '<a href="'.$data->imagePath.'" target="_blank"><img src="'.$data->imagePath.'" width="70" class="img-thumbnail" /></a>';
                        return $img; 

                    }) 
                    ->addColumn('branchphone', function($data) {
                      $phone = $data->phone;
                      return  $phone ;

                    }) 
                    ->addColumn('branchaddress', function($data) {
                      $address = Str::title($data->address);
                      return  $address ;

                    }) 
                    ->addColumn('branchstatus', function($data) {
                       if($data->status == "active"){
                            $status = '<div class="center"><label class="switch"><input type="checkbox" checked  rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                                ';

                            return $status;
                        }else{
                            $status = '<div class="center"><label class="switch"><input type="checkbox" rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                            ';
                            return $status;

                        }

                    }) 
                      ->addColumn('branchstatus', function($data) {
                       if($data->status == "active"){
                            $status = '<div class="center"><label class="switch"><input type="checkbox" checked  rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                                ';

                            return $status;
                        }else{
                            $status = '<div class="center"><label class="switch"><input type="checkbox" rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                            ';
                            return $status;

                        }

                    }) 
                    ->addColumn('pickupstatus', function($data) {
                       if($data->pickup_status == "active"){
                            $pickup_status = '<div class="center"><label class="switch"><input type="checkbox" checked  rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                                ';

                            return $pickup_status;
                        }else{
                            $pickup_status = '<div class="center"><label class="switch"><input type="checkbox" rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                            ';
                            return $pickup_status;

                        }

                    }) 
                     ->addColumn('delivarystatus', function($data) {
                       if($data->delivray_status == "active"){
                            $delivray_status = '<div class="center"><label class="switch"><input type="checkbox" checked  rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                                ';

                            return $delivray_status;
                        }else{
                            $delivray_status = '<div class="center"><label class="switch"><input type="checkbox" rel="'.$data->id.'" class="user_status"><span class="slider round"></span></label></div>
                            ';
                            return $delivray_status;

                        }

                    }) 

                   ->addColumn('created_at', function($data) {
                      $a = Carbon::parse($data->created_at)->format('d/m/Y  h:i:s A');
                      return $a;                   
                    })
                                          
                    ->addColumn('action', function($data){

                        $button = '&nbsp;<button class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;<a href="'.url('/control-area/view-branch-detail/').'/'.$data->id.'" class="m-5-r show-booking btn btn-success btn-sm" id="'.$data->id.'"><i class="fa fa-eye"></i></a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','branchname','branchsku','branchimage','branchphone','branchaddress','branchstatus','pickupstatus','delivarystatus','created_at','updated_at','action'])
                    ->make(true);
        }
        return view('back.pages.branches');
    }

    public function addeditbranch(Request $request, $id=null)
    {   
        if($id==""){
            $title = "Add Branch";
            $branchdata= new Branch;
            $branchdata = array();
            return view('back.pages.addedit-branch')->with(compact('title','branchdata',));

        }else{

            $title = "Edit Branch";
            $branchdata = Branch::where('id', $id)->first();
            $branchdata = json_decode(json_encode($branchdata),true);
            if(empty($branchdata)){
               abort(404);
            }else{
               return view('back.pages.addedit-branch')->with(compact('title','branchdata'));
            }
        } 
    }
}
