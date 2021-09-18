<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'api'],function(){

Route::post('signin','AuthController@signin');
Route::post('signup','AuthController@signup');
Route::post('user','AuthController@user');

Route::apiResource('/employee', 'EmployeeController');
Route::any('searchemployee','EmployeeController@searchemployee');
Route::apiResource('/supplier', 'SupplierController');
Route::any('searchsupplier','SupplierController@searchsupplier');
Route::apiResource('/category', 'CategoryController');
Route::any('searchcategory','CategoryController@searchcategory');
Route::apiResource('/product', 'ProductController');
});
