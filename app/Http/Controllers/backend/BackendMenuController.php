<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB; 
use Validator; 
use Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Gate;
class BackendMenuController extends Controller
{
    public function index(Request $request){

        if($request->ajax())
        {
            $data = Menu::orderBy('created_at', 'desc')->get();
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
                      $catname = '<a href="'.url('/control-area/categories/').'">'.Str::title($data->category->name).'</a>' ;
                      return  $catname ;
                    })
                    ->addColumn('menuname', function($data) {
                      $name = Str::title($data->name);
                      return  $name ;

                    })
                    ->addColumn('menusku', function($data) {
                      $sku = $data->sku;
                      return  $sku ;

                    })  
                    ->addColumn('menuprice', function($data) {
                      $price = '$'.$data->price;
                      return  $price ;

                    }) 
                    ->addColumn('menuimage', function($data) {
                         $img = '<a href="'.$data->imagePath.'" target="_blank"><img src="'.$data->imagePath.'" width="40" class="img-thumbnail" /></a>';
                        return $img; 

                    }) 
                    ->addColumn('menustatus', function($data) {
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

                   ->addColumn('menucreated_at', function($data) {
                      $a = Carbon::parse($data->created_at)->format('d/m/Y  h:i:s A');
                      return $a;                   
                    })
                                          
                    ->addColumn('action', function($data){

                        $button = '&nbsp;<button class=" edit btn btn-add btn-sm" id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                         $button .= '&nbsp;<a href="'.url('/control-area/view-branch-detail/').'/'.$data->id.'" class="m-5-r show-booking btn btn-success btn-sm" id="'.$data->id.'"><i class="fa fa-eye"></i></a>';
                        return $button;
                        
                    }) 
                    
                    ->rawColumns(['checkbox','branchname','catname','menuname','menusku','menuprice','menuimage','menustatus','menucreated_at','action'])
                    ->make(true);
        }
        return view('back.pages.menus');
    }
    public function addeditmenu(Request $request, $id=null)
    {   
        if($id==""){
            $title = "Add Menu";
            $menudata= new Menu;
            $menudata = array();
            return view('back.pages.addedit-menu')->with(compact('title','menudata'));

        }else{

            $title = "Edit Menu";
            $menudata = Menu::where('id', $id)->first();
            $menudata = json_decode(json_encode($menudata),true);
            if(empty($menudata)){
               abort(404);
            }else{
               return view('back.pages.addedit-menu')->with(compact('title','menudata'));
            }
        } 
    } 
}
