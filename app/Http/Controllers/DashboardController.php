<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Dashboard home page
    public function index(){
        return view('backend/index');
      }
}
