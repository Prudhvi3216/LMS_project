<?php

namespace App\Http\Controllers\Admin;

//Model
use App\Category as Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::Select('id', 'name', 'slug')->get();
        return view('backend/categories/Categories')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/categories/CategoriesAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required',
        ]);
        if($validatedData){
            $category = new Categories;
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect('categories')->with(['alert_type'=>'success', 'alert_message'=>'Category Added Successfully']);
        }
        else{
          $errors = $validatedData()->errors();
          dd($errors);
          //return redirect('categories')->with(['alert_type'=>'danger', 'alert_message'=>$errors]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $params = Categories::find($id, ['id', 'name', 'slug']);
        return view('backend/categories/CategoriesEdit')->with('params', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if($validatedData){
            $category = Categories::find($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            $alert_message = 'Category Updated Successfully';
            /* if($resquest->expectsJson()){
                return response()->json($alert_message);
            } */
            return response()->json(['alert' => $alert_message]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        $alert_type = 'danger';
        $alert_message = 'Category Deleted Successfully';
        return redirect('categories')->with(['alert_type'=>$alert_type, 'alert_message'=>$alert_message]);
    }
}
