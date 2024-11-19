<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\crud;
use App\Http\Controllers\DashbordController;
 use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use GuzzleHttp\Middleware;

Route::post('/success',[UserController::class,'login']);
 

Route::get('/customer',action: [InventoryController::class,"customer"])->middleware(ValidUser::class);
Route::post('/add_cus',[crud::class,"add_customer"])->middleware(ValidUser::class);
Route::get('/customer/delete/{id}',[crud::class,"delete"])->middleware(ValidUser::class);
route::get('/customer/update/{id}' ,[crud::class,'update_dtls']);
route::post('/customers/update/{id}' ,[crud::class,'update'])->middleware(ValidUser::class);
Route::post('getcustomer',[crud::class,'getCustomer'])->middleware(ValidUser::class);




Route::get('/category',[InventoryController::class,"category"])
->middleware(ValidUser::class);
Route::post('/add_category',[CategoryController::class,"add_category"])->middleware(ValidUser::class);
 Route::get('/category/delete/{id}',[CategoryController::class,"delete"]);



Route::get('/items',[InventoryController::class,"items"])->middleware(ValidUser::class);
Route::post('/insert_product',[ProductController::class,"add_product"])->middleware(ValidUser::class);
Route::get('/item/delete/{id}',[ProductController:: class,"delete"])->middleware(ValidUser::class);
route::get('/item/update/{id}' ,[ProductController::class,'update_dtls'])->middleware(ValidUser::class);
route::post('/item/update/{id}' ,[ProductController::class,'update']);




Route::get('/selling',action: [InventoryController::class,"selling"])->middleware(ValidUser::class);
Route::get('/details/{id}',[SellingController:: class,"details"])->middleware(ValidUser::class);

Route::post('search/{id}', [SellingController::class, 'search'])->name('search');


Route::get('/updateinventory', [SellingController::class, 'updateInventory']);





// ->middleware(ValidUser::class);
Route::get('/sell',action: [SellingController::class,"sell"])->middleware(ValidUser::class);
Route::post('/addrecord',action: [SellingController::class,"addrecord"])->middleware(ValidUser::class);
Route::get('/login',  action: [LoginController::class,'index'])->name('login');
Route::post('logout/',[UserController::class,'logout']);
Route::get('/',  action: [LoginController::class,'index'])->name('login');


 
 

Route::get('/dashbord',[DashbordController::class,'dashbord'])->middleware(ValidUser::class);
Route::post('/registration',[UserController::class,'register']);


Route::get('/test', action: [InventoryController::class,"test"]);




 

// get cus name 
Route::get('/getname',[crud::class,"getname"]);
Route::get('/getcat',[SellingController::class,"getcat"]);
Route::get('/getproductdetails',[SellingController::class,"getproductDetails"]);


 
// require __DIR__.'/auth.php';
