<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendIndexController extends Controller
{
    public function index(Request $request){
       return view('back.pages.dashboard');     
    }

}
