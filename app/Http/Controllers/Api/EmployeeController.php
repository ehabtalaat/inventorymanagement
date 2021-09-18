<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
       $employees = Employee::paginate(1);

       return response()->json($employees);
    }

  public function searchemployee(Request $request){
    if($name = $request->name){
        $employees = Employee::where('name','LIKE',"%{$name}%")->paginate(1);
    }else{
          $employees = Employee::paginate(1);
      }
        return response()->json($employees);
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
         'name' => 'required|unique:employees|max:255',
         'email' => 'required',
         'phone' => 'required|unique:employees',

        ]);
        

         $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->sallery = $request->sallery;
         $employee->address = $request->address;
         $employee->joining_date = $request->joining_date;
          if ($request->photo) {
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];
         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);
         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         if (!file_exists(public_path($upload_path))) {
    mkdir(public_path($upload_path), 777, true);

}
         $img->save(public_path($image_url));
         $employee->photo = $image_url;
     }
         $employee->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id',$id)->first();
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
        

          $employee = Employee::where('id',$id)->first();
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->sallery = $request->sallery;
         $employee->address = $request->address;
         $employee->joining_date = $request->joining_date;
          if ($request->newphoto) {
            if($employee->photo){
            unlink($employee->photo);
        }
         $position = strpos($request->photo, ';');
         $sub = substr($request->photo, 0, $position);
         $ext = explode('/', $sub)[1];
         $name = time().".".$ext;
         $img = Image::make($request->photo)->resize(240,200);
         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         if (!file_exists(public_path($upload_path))) {
    mkdir(public_path($upload_path), 777, true);

}
         $img->save(public_path($image_url));
         $employee->photo = $image_url;
     }
         $employee->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id',$id)->first();
       
        if($employee->photo){
            unlink($employee->photo);
        }
         $employee->delete();
        return response()->json(['status' => true]);
    }
}
