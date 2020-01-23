<?php

namespace App\Http\Controllers;

//Models
use App\Category as Categories;

use Illuminate\Http\Request;

class VueController extends Controller
{
    //Categories list for Course from
    public function categories_list(){
        $categories_list = Categories::Select('id', 'name')->get();
        return response()->json(['categories'=>$categories_list]);
    }

    public function curriculum(){
        return view('backend/courses/curriculum');
    }
}
