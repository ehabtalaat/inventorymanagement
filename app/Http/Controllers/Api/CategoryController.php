<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
       $categories = Category::all();

       return response()->json($categories);
    }

  public function searchcategory(Request $request){
    if($name = $request->name){
        $categories = Category::where('name','LIKE',"%{$name}%")->paginate(1);
    }else{
        $categories = Category::paginate(1);
}
        return response()->json($categories);
  }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validateData = $request->validate([
         'name' => 'required|unique:categories|max:255',

        ]);
        

         $category = new Category;
         $category->name = $request->name;
         $category->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id',$id)->first();
          return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
       $validateData = $request->validate([
         'name' => "required|unique:categories,name,$id|max:255",

        ]);
        

          $category = Category::where('id',$id)->first();
         $category->name = $request->name;
         $category->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id',$id)->first();
         $category->delete();
        return response()->json(['status' => true]);
    }
}
