<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
use DB;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
       $suppliers= Supplier::all();

       return response()->json($suppliers);
    }

  public function searchsupplier(Request $request){
    if($name = $request->name){
        $suppliers = Supplier::where('name','LIKE',"%{$name}%")->paginate(1);
    }else{
        $suppliers= Supplier::paginate(1);
    }
        return response()->json($suppliers);
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
         'name' => 'required|unique:suppliers|max:255',
         'email' => 'required',
         'phone' => 'required|unique:suppliers',

        ]);
        

         $supplier = new Supplier;
         $supplier->name = $request->name;
         $supplier->email = $request->email;
         $supplier->phone = $request->phone;
         $supplier->address = $request->address;
          if ($request->photo) {
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];
         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);
         $upload_path = 'backend/supplier/';
         $image_url = $upload_path.$name;
         if (!file_exists(public_path($upload_path))) {
    mkdir(public_path($upload_path), 777, true);

}
         $img->save(public_path($image_url));
         $supplier->photo = $image_url;
     }
         $supplier->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Supplier::where('id',$id)->first();
          return response()->json($employee);
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
         'name' => "required|unique:employees,name,$id|max:255",
         'email' => 'required',
         'phone' => "required|unique:employees,phone,$id",

        ]);
        

          $supplier = Supplier::where('id',$id)->first();
         $supplier->name = $request->name;
         $supplier->email = $request->email;
         $supplier->phone = $request->phone;
         $supplier->address = $request->address;
          if ($request->newphoto) {
            if($employee->photo){
            unlink($employee->photo);
        }
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];
         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);
         $upload_path = 'backend/supplier/';
         $image_url = $upload_path.$name;
         if (!file_exists(public_path($upload_path))) {
    mkdir(public_path($upload_path), 777, true);

}
         $img->save(public_path($image_url));
         $supplier->photo = $image_url;
     }
         $supplier->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id',$id)->first();
       
        if($supplier->photo){
            unlink($supplier->photo);
        }
         $supplier->delete();
        return response()->json(['status' => true]);
    }
}
