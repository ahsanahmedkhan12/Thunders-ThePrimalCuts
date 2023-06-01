<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Category;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB; 
use Validator; 
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Gate;
class BackendCategoriesController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {

            $data = Category::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                    ->addColumn('checkbox', function($data){ 
                        $checkbox =  '<input type="checkbox" name="category_checkbox" class="checkboxsingle" value="'.$data->id.'" >';
                              return $checkbox;
                    }) 
                    ->addColumn('branchname', function($data) {
                      $branchname = '<a href="'.url('/control-area/branches/').'">'.Str::title($data->branch->name).'</a>' ;
                      return  $branchname ;
                    }) 
                    ->addColumn('catname', function($data) {
                      $name = Str::title($data->name);
                      return  $name ;
                    }) 
                    ->addColumn('catsku', function($data) {
                      $sku = Str::title($data->sku);
                      return  $sku ;

                    })  
                    ->addColumn('catimage', function($data) {
                         $img = '<a href="'.$data->imagePath.'" target="_blank"><img src="'.$data->imagePath.'" width="40" class="img-thumbnail" /></a>';
                        return $img; 

                    }) 
                    ->addColumn('catstatus', function($data) {
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

                   ->addColumn('catcreated_at', function($data) {
                      $a = Carbon::parse($data->created_at)->format('d/m/Y  h:i:s A');
                      return $a;                   
                    })
                                          
                    ->addColumn('action', function($data){

                        $button = '&nbsp;<button class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                         $button .= '&nbsp;<a href="'.url('/control-area/view-branch-detail/').'/'.$data->id.'" class="m-5-r show-booking btn btn-success btn-sm" id="'.$data->id.'"><i class="fa fa-eye"></i></a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','branchname','catname','catsku','catimage','catstatus','catcreated_at','action'])
                    ->make(true);
        }

        return view('back.pages.categories');
    }
    public function addeditcategory(Request $request, $id=null)
    {   
        if($id==""){

            $title = "Add Category";
            $categorydata= new Category;
            $categorydata = array();
            return view('back.pages.addedit-category')->with(compact('title','categorydata'));

        }else{

            $title = "Edit Category";
            $categorydata = Category::where('id', $id)->first();
            $categorydata = json_decode(json_encode($categorydata),true);
            if(empty($categorydata)){
               abort(404);
            }else{
               return view('back.pages.addedit-category')->with(compact('title','categorydata'));
            }
        } 
    } 
}
